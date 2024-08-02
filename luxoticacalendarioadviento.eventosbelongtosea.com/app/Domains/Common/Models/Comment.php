<?php

namespace App\Domains\Common\Models;

use App\Domains\Auth\Models\User;
use App\Domains\Common\Concerns\WithLikes;
use App\Domains\Common\Models\Traits\Scope\CommentScope;
use App\Domains\Responses\Models\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\morphTo;
use phpDocumentor\Reflection\Types\Boolean;

class Comment extends Model
{
    use WithLikes;
    use CommentScope;

    const COMMENTS_OPEN_FREE = 1;
    const COMMENTS_OPEN_MOD = 2;
    const COMMENTS_CLOSED = 3;
    const COMMENTS_OFF = 4;

    const ALLOWED_OWNERS = [Response::class];
    const ALLOWED_EDIT_TIME = 10;
    const ALLOWED_DELETE_TIME = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'user_id',
      'post_id',
      'state_id',
      'content',
    ];

    protected $casts = [
        'published' => 'boolean',
        'verified_at' => 'datetime',
        'created_at' => 'datetime',
    ];


    /**
     * Return the comment's author
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Return the comment's owner
     */

    public function owner(): morphTo
    {
        return $this->morphTo();
    }

    public function isPublished()
    {
        return $this->published;
    }

    public function responses()
    {
        return $this->belongsTo(Response::class, 'owner_id')
            ->whereOwnerType(Response::class);
    }

}
