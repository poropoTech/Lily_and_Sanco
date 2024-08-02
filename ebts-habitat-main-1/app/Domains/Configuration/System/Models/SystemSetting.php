<?php

namespace App\Domains\Configuration\System\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class SystemSetting.
 */
class SystemSetting extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'system_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
    ];

}
