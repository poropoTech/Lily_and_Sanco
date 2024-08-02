<?php

namespace App\Domains\Structure\Models;

use App\Domains\Structure\Models\Traits\Attribute\ActivityAttribute;
use App\Domains\Structure\Models\Traits\Method\ActivityMethod;
use App\Domains\Structure\Models\Traits\Relationship\ActivityRelationship;
use App\Domains\Structure\Models\Traits\Scope\ActivityScope;
use Database\Factories\ActivityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * Class Activity.
 */
class Activity extends Model implements HasMedia
{
    use HasFactory,
        ActivityAttribute,
        ActivityMethod,
        ActivityRelationship,
        ActivityScope,
        InteractsWithMedia;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'activities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'title',
        'card_content',
        'intro_content',
        'individual_content',
        'individual_type_id',
        'collective_content',
        'collective_type_id',
        'order',
        'published',
        'active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    protected $casts = [
        'published' => 'boolean',
        'enabled' => 'boolean',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return ActivityFactory::new();
    }
}
