<?php

namespace App\Domains\Structure\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category.
 */
class CategoryTranslation extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories_lang';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lang',
        'name',
        'description',
        'content',
    ];

}
