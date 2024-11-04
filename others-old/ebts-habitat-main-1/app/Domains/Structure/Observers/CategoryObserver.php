<?php

namespace App\Domains\Structure\Observers;

use App\Domains\Structure\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{

    public function updating(Category $category): void
    {
        $this->generateSlug($category);
    }


    public function creating(Category $category): void
    {
        $this->generateSlug($category);
    }

    private function generateSlug(Category $category): void
    {
        $subfix = 1;

        if (Category::where('slug', Str::slug($category->name, '-'))->exists()) {
            while (Category::where('slug', Str::slug($category->name . ' ' . $subfix, '-'))->exists()) {
                $subfix++;
            }
            $category->slug = Str::slug($category->name . ' ' . $subfix, '-');
        } else {
            $category->slug = Str::slug($category->name, '-');
        }
    }
}
