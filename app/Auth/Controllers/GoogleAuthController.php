<?php

namespace App\Auth\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use App\Auth\Actions\HandleGoogleCallbackAction;

class GoogleAuthController
{
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(HandleGoogleCallbackAction $action, Request $request): RedirectResponse
    {
        $action->execute($request);

        return redirect()->intended('/api/me');
    }
}
