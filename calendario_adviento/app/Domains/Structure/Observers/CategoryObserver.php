<?php

namespace App\Domains\Structure\Observers;

use App\Domains\Configuration\System\Services\SystemConfigurationService;
use App\Domains\Structure\Models\Category;
use App\Domains\Structure\Models\CategoryTranslation;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

class CategoryObserver
{
    protected array $runningConfiguration;


    public function __construct(SystemConfigurationService $configurationService)
    {
        $this->runningConfiguration = $configurationService->getConfigSettings(
            [
                'app.running.auto-mode',
                'app.running.start-date',
            ]
        );
    }

    public function retrieved(Category $category): void
    {
        if ($this->runningConfiguration['app.running.auto-mode']) {
            $startDate = Date::createFromFormat('d/m/Y', $this->runningConfiguration['app.running.start-date']);
            $currentDate = Date::now();
            if (Date::now() >= $startDate) {
                $days = $startDate->diffInDays($currentDate);
                if ($days >= $category->order - 1) {
                    $category->active = 1;
                } else {
                    $category->active = 0;
                }
            } else {
                $category->active = 0;
            }
        }

        if($translation = $category->translations()->whereLang(app()->getLocale())->first()){
            $category->name = $translation->name ?: $category->name;
            $category->description = $translation->description ?: $category->description;
            $category->content = $translation->content ?: $category->content;
        }

    }

    public function updating(Category $category): void
    {
        if($translation = $category->translations()->whereLang(app()->getLocale())->first()){
            $translation->name = $category->name;
            $translation->description = $category->description;
            $translation->content = $category->content;
            $translation->save();
        } else {
            $category->translations()->create(
                [
                    'lang' => app()->getLocale(),
                    'name' => $category->name,
                    'description' => $category->description,
                    'content' => $category->content
                ]
            );
        }

        if(config('boilerplate.locale.language') === app()->getLocale()) {
            $this->generateSlug($category);
        } else {
            $category->name = $category->getOriginal('name');
            $category->description = $category->getOriginal('description');
            $category->content = $category->getOriginal('content');
        }
    }


    public function creating(Category $category): void
    {
        $this->generateSlug($category);
    }

    public function created(Category $category): void
    {
        $langs = config('boilerplate.locale.languages');

        foreach ($langs as $code => $lang) {
            if(config('boilerplate.locale.language') === $code){
                $category->translations()->create(
                    [
                        'lang' => $code,
                        'name' => $category->name,
                        'description' => $category->description,
                        'content' => $category->content
                    ]
                );
            } else {
                $category->translations()->create(
                    [
                        'lang' => $code,
                        'name' => '',
                        'description' => '',
                        'content' => ''
                    ]
                );
            }
        }
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
