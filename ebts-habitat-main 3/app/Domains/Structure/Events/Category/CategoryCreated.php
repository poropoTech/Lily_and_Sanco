<?php

namespace App\Domains\Structure\Events\Category;

use App\Domains\Structure\Models\Category;
use Illuminate\Queue\SerializesModels;

/**
 * Class CategoryCreated.
 */
class CategoryCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $category;

    /**
     * @param $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
}