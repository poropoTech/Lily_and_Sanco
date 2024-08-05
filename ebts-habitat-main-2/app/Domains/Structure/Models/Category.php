<?php

namespace App\Domains\Structure\Models;

use App\Domains\Structure\Models\Traits\Attribute\CategoryAttribute;
use App\Domains\Structure\Models\Traits\Method\CategoryMethod;
use App\Domains\Structure\Models\Traits\Relationship\CategoryRelationship;
use App\Domains\Structure\Models\Traits\Scope\CategoryScope;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * Class Category.
 */
class Category extends Model implements HasMedia
{
    use HasFactory,
        CategoryAttribute,
        CategoryMethod,
        CategoryRelationship,
        CategoryScope,
        InteractsWithMedia;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'content',
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
        return CategoryFactory::new();
    }
}
