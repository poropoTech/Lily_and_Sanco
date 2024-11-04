<?php

namespace App\Domains\Statistics\Models;

use App\Domains\Statistics\Models\Traits\Relationship\ViewRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * Class View.
 */
class View extends Model
{
    use ViewRelationship;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'views';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'activity_id',
        'user_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
