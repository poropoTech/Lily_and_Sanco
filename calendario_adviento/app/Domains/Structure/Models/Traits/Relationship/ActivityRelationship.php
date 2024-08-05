<?php

namespace App\Domains\Structure\Models\Traits\Relationship;

use App\Domains\Responses\Models\Response;
use App\Domains\Statistics\Models\View;
use App\Domains\Structure\Models\ActivityTranslation;
use App\Domains\Structure\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class ActivityRelationship.
 */
trait ActivityRelationship
{

    public function responses(): hasMany
    {
        return $this->hasMany(Response::class, 'activity_id');
    }

    public function views(): hasMany
    {
        return $this->hasMany(View::class, 'activity_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function translations(): hasMany
    {
        return $this->hasMany(ActivityTranslation::class, 'activity_id');
    }
}
