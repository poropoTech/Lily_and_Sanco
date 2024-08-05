<?php

namespace App\Http\Controllers;

use App\Domains\Auth\Services\UserService;
use Illuminate\Support\Facades\Auth;

/**
 * Class LocaleController.
 */
class LocaleController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param $locale
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change($locale)
    {
        app()->setLocale($locale);

        session()->put('locale', $locale);

        if($user = Auth::user()) {
            $user->lang = $locale;
            $user->save();
        }

        return redirect()->back();
    }
}
