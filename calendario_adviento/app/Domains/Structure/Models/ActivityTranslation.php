<?php

namespace App\Domains\Structure\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category.
 */
class ActivityTranslation extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'activities_lang';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lang',
        'title',
        'card_content',
        'intro_content',
        'individual_content',
        'collective_content'
    ];

}
