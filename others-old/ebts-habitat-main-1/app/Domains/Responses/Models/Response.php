<?php

namespace App\Domains\Responses\Models;

use App\Domains\Common\Concerns\WithComments;
use App\Domains\Common\Concerns\WithLikes;
use App\Domains\Responses\Models\Traits\Attribute\ResponseAttribute;
use App\Domains\Responses\Models\Traits\Method\ResponseMethod;
use App\Domains\Responses\Models\Traits\Relationship\ResponseRelationship;
use App\Domains\Responses\Models\Traits\Scope\ResponseScope;
use Database\Factories\ResponseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * Class Response.
 */
class Response extends Model implements HasMedia
{
    use HasFactory,
        ResponseAttribute,
        ResponseMethod,
        ResponseRelationship,
        ResponseScope,
        InteractsWithMedia,
        WithLikes,
        WithComments;

    const TYPES = [
        'CLICK' => ['id' => 1, 'name' => 'Click'],
        'T' => ['id' => 2, 'name' => 'Texto'],
        'T_I' => ['id' => 3, 'name' => 'Texto e imagen'],
        'T_PDF' => ['id' => 4, 'name' => 'Texto y fichero .pdf'],
        'T_V' => ['id' => 5, 'name' => 'Texto y vídeo'],
        'T_LINK' => ['id' => 6, 'name' => 'Texto y enlace'],
        'T_OI' => ['id' => 7, 'name' => 'Texto e imagen opcional'],
    ];

    const TYPE_CLICK = 1;
    const TYPE_T = 2;
    const TYPE_T_I = 3;
    const TYPE_T_PDF = 4;
    const TYPE_T_V = 5;
    const TYPE_T_LINK = 6;
    const TYPE_T_OI = 7;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'responses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'activity_id',
        'user_id',
        'type_id',
        'challenge',
        'title',
        'content',
        'ext_content',
        'ext_content_type',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
        'verified_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    public const externalVideoProviders = ['youtube.com', 'youtu.be', 'vimeo.com'];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return ResponseFactory::new();
    }
}
