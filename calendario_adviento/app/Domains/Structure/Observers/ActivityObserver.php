<?php

namespace App\Domains\Structure\Observers;

use App\Domains\Structure\Models\Activity;
use Illuminate\Support\Str;

class ActivityObserver
{
    public function retrieved(Activity $activity): void
    {
        if (! $activity->category->active) {
            $activity->active = 0;
        }

        if($translation = $activity->translations()->whereLang(app()->getLocale())->first()){
            $activity->title = $translation->title ?: $activity->title;
            $activity->card_content = $translation->card_content ?: $activity->card_content;
            $activity->intro_content = $translation->intro_content ?: $activity->intro_content;
            $activity->individual_content = $translation->individual_content ?: $activity->individual_content;
            $activity->collective_content = $translation->collective_content ?: $activity->collective_content;
        }
    }

    public function updating(Activity $activity): void
    {
        if($translation = $activity->translations()->whereLang(app()->getLocale())->first()){
            $translation->title = $activity->title;
            $translation->card_content = $activity->card_content;
            $translation->intro_content = $activity->intro_content;
            $translation->individual_content = $activity->individual_content;
            $translation->collective_content = $activity->collective_content;

            $translation->save();
        } else {
            $activity->translations()->create(
                [
                    'lang' => app()->getLocale(),
                    'title' => $activity->title,
                    'card_content' => $activity->card_content,
                    'intro_content' => $activity->intro_content,
                    'individual_content' => $activity->individual_content,
                    'collective_content' => $activity->collective_content,
                ]
            );
        }

        if(config('boilerplate.locale.language') === app()->getLocale()) {
            $this->generateSlug($activity);
        } else {
            $activity->title = $activity->getOriginal('title');
            $activity->card_content = $activity->getOriginal('card_content');
            $activity->intro_content = $activity->getOriginal('intro_content');
            $activity->individual_content = $activity->getOriginal('individual_content');
            $activity->collective_content = $activity->getOriginal('collective_content');
        }
    }


    public function creating(Activity $activity): void
    {
        $this->generateSlug($activity);
    }

    public function created(Activity $activity): void
    {
        $langs = config('boilerplate.locale.languages');

        foreach ($langs as $code => $lang) {
            if(config('boilerplate.locale.language') === $code){
                $activity->translations()->create(
                    [
                        'lang' => app()->getLocale(),
                        'title' => $activity->title,
                        'card_content' => $activity->card_content,
                        'intro_content' => $activity->intro_content,
                        'individual_content' => $activity->individual_content,
                        'collective_content' => $activity->collective_content,
                    ]
                );
            } else {
                $activity->translations()->create(
                    [
                        'lang' => $code,
                        'title' => '',
                        'card_content' => '',
                        'intro_content' => '',
                        'individual_content' => '',
                        'collective_content' => '',
                    ]
                );
            }
        }
    }

    private function generateSlug(Activity $activity): void
    {
        $subfix = 1;

        if (Activity::where('slug', Str::slug($activity->title, '-'))->exists()) {
            while (Activity::where('slug', Str::slug($activity->title . ' ' . $subfix, '-'))->exists()) {
                $subfix++;
            }
            $activity->slug = Str::slug($activity->title . ' ' . $subfix, '-');
        } else {
            $activity->slug = Str::slug($activity->title, '-');
        }
    }
}
