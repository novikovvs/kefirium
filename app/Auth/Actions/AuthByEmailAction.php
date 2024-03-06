<?php

namespace App\Auth\Actions;

use Illuminate\Support\Facades\Auth;

readonly class AuthByEmailAction
{
    public function execute(array $credential): bool
    {
        return Auth::attempt($credential);
    }
}
