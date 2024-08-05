<?php

namespace App\Domains\Common\Services;

use App\Domains\Auth\Models\User;
use App\Domains\Common\Events\Comment\CommentCreated;
use App\Domains\Common\Models\Comment;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class CommentService.
 */
class CommentService extends BaseService
{
    /**
     * CommentService constructor.
     *
     * @param  Comment  $comment
     */
    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }


    public function store(User $user, $entity, array $data = []): Comment
    {
        if (! in_array(get_class($entity), Comment::ALLOWED_OWNERS)) {
            throw new GeneralException(__('La entidad no es comentable'));
        }

        if (! $entity->commentsEnabled()) {
            throw new GeneralException(__('Los comentarios no están activados'));
        }

        // TODO: Check adicional para comprobar si el usuario puede comentar en la entidad.

        DB::beginTransaction();

        try {

            $comment = new Comment();
            $comment->user_id = $user->id;
            $comment->content = $data['content'];

            if (getSysSetting('app.comments.verification-required')) {
                $comment->published = false;
            }

            $comment->owner()->associate($entity);
            $comment->save();

        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('Hubo un problema creando el comentario.'));
        }

        event(new CommentCreated($comment));

        DB::commit();

        return $comment;
    }

    public function publish(Comment $comment): void
    {
        $comment->published = true;
        $comment->save();

//        event(new CommentPublished($comment));
    }

    public function unpublish(Comment $comment): void
    {
        $comment->published = false;
        $comment->save();

//        event(new CommentUnpublished($comment));
    }


    public function destroy(Comment $comment): void
    {
        try {
            $comment->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__('Error eliminando comentario.'));
        }

//        event(new CommentDeleted($comment));
    }
}
