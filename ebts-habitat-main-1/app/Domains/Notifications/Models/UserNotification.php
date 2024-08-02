<?php

namespace App\Domains\Notifications\Models;

use App\Domains\Notifications\Models\Traits\Relationship\UserNotificationRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserNotification.
 */
class UserNotification extends Model
{
    use UserNotificationRelationship;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_notifications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

}
