<?php

namespace App\Domains\Structure\Services;

use App\Domains\Auth\Models\User;
use App\Domains\Structure\Events\Activity\ActivityCreated;
use App\Domains\Structure\Events\Activity\ActivityDeleted;
use App\Domains\Structure\Events\Activity\ActivityPublished;
use App\Domains\Structure\Events\Activity\ActivityUpdated;
use App\Domains\Structure\Models\Activity;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class ActivityService.
 */
class ActivityService extends BaseService
{
    /**
     * ActivityService constructor.
     *
     * @param  Activity  $activity
     */
    public function __construct(Activity $activity)
    {
        $this->model = $activity;
    }

    /**
     * @param  array  $data
     *
     * @return Activity
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Activity
    {
        DB::beginTransaction();

        try {
            $activity = $this->model::create([
                'category_id' => $data['category_id'],
                'title' => $data['title'],
                'card_content' => $data['card_content'],
                'intro_content' => $data['intro_content'],
                'individual_content' => $data['individual_content'],
                'individual_type_id' => $data['individual_type_id'],
                'collective_content' => $data['collective_content'],
                'collective_type_id' => $data['collective_type_id'],
                'order' => $data['order'],
                'published' => $data['published'],
                'active' => $data['active'],
            ]);

            if (isset($data['image_header']) && isset($data['image_card'])) {
                $activity->addMediaFromBase64($data['image_header'])
                    ->usingName('Imagen de cabecera')
                    ->usingFileName(getRandomFilenameFromB64($data['image_header']))
                    ->toMediaCollection('image_header');

                $activity->addMediaFromBase64($data['image_card'])
                    ->usingName('Imagen')
                    ->usingFileName(getRandomFilenameFromB64($data['image_card']))
                    ->toMediaCollection('image_card');
            }
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('Hubo un problema creando la actividad.'));
        }

        event(new ActivityCreated($activity));
        if ($activity->published) {
            event(new ActivityPublished($activity));
        }

        DB::commit();

        return $activity;
    }

    /**
     * @param  Activity  $activity
     * @param  array  $data
     *
     * @return Activity
     * @throws GeneralException
     * @throws \Throwable
     */
    public function update(Activity $activity, array $data = []): Activity
    {
        $oldPublishState = $activity->published;

        DB::beginTransaction();

        try {
            $activity->update([
                'category_id' => $data['category_id'],
                'title' => $data['title'],
                'card_content' => $data['card_content'],
                'intro_content' => $data['intro_content'],
                'individual_content' => $data['individual_content'],
                'individual_type_id' => $data['individual_type_id'],
                'collective_content' => $data['collective_content'],
                'collective_type_id' => $data['collective_type_id'],
                'order' => $data['order'],
                'published' => $data['published'],
                'active' => $data['active'],
            ]);


            if (isset($data['image_header']) && isset($data['image_card'])) {
                $activity->deleteImages();
                $activity->addMediaFromBase64($data['image_header'])
                    ->usingName('Imagen de cabecera')
                    ->usingFileName(getRandomFilenameFromB64($data['image_header']))
                    ->toMediaCollection('image_header');

                $activity->addMediaFromBase64($data['image_card'])
                    ->usingName('Imagen')
                    ->usingFileName(getRandomFilenameFromB64($data['image_card']))
                    ->toMediaCollection('image_card');
            }
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('Hubo un problema actualizando la actividad.'));
        }


        event(new ActivityUpdated($activity));
        if ($activity->published && $oldPublishState == false) {
            event(new ActivityPublished($activity));
        }

        DB::commit();

        return $activity;
    }

    /**
     * @param  Activity  $activity
     *
     * @return Activity
     * @throws GeneralException
     * @throws \Throwable
     */
    public function copy(Activity $activity): Activity
    {
        $activityData = $activity->toArray();
        unset($activityData['id']);
        unset($activityData['slug']);
        unset($activityData['created_at']);
        unset($activityData['updated_at']);
        $activityData['title'] = '_[COPIA]_ '.$activityData['title'];
        $activityData['published'] = false;

        DB::beginTransaction();

        try {
            $copiedActivity = $this->model::create($activityData);
            $copiedActivity->addMediaFromUrl($activity->imageHeaderURL)
                ->usingName('Imagen de cabecera')
                ->toMediaCollection('image_header');

            $copiedActivity->addMediaFromUrl($activity->imageCardURL)
                ->usingName('Imagen')
                ->toMediaCollection('image_card');
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('Hubo un problema actualizando la actividad.'));
        }


        DB::commit();

        return $activity;
    }

    /**
     * @param  Activity  $activity
     *
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Activity $activity): bool
    {
        if ($activity->responses()->count()) {
            throw new GeneralException(__('No se puede eliminar una actividad con respuestas asociadas'));
        }

        if ($this->deleteById($activity->id)) {
            event(new ActivityDeleted($activity));

            return true;
        }

        throw new GeneralException(__('Hubo un problema eliminando la actividad.'));
    }

    public function getNotDoneByUser(User $user)
    {
        $query = DB::select(
            'select a.* from categories c inner join activities a on c.id = a.category_id
                            where a.id not in (select activity_id from responses r
                            where user_id = :user group by activity_id having count(*) = 2)
                            order by a.created_at',
            ['user' => $user->id]
        );

        return Activity::hydrate($query->toArray());
    }
}
