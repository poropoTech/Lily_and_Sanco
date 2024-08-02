<?php

namespace App\Domains\Auth\Models;

use App\Domains\Auth\Models\Traits\Attribute\DepartmentAttribute;
use App\Domains\Auth\Models\Traits\Method\DepartmentMethod;
use App\Domains\Auth\Models\Traits\Relationship\DepartmentRelationship;
use App\Domains\Auth\Models\Traits\Scope\DepartmentScope;
use Database\Factories\DepartmentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Department.
 */
class Department extends Model
{
    use HasFactory,
        DepartmentAttribute,
        DepartmentMethod,
        DepartmentRelationship,
        DepartmentScope;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'departments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
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
        return DepartmentFactory::new();
    }
}
