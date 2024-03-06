<?php

namespace App\Users\Actions;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Contracts\User;
use App\Users\Models\User as UserModel;

readonly class CreateUserBySocialiteAction
{
    public function execute(User $user): UserModel
    {
        $newUser = new UserModel();
        $newUser->name = $user->name ?? $user->getName();
        $newUser->email = $user->email ?? $user->getEmail();
        $newUser->google_id = $user->id ?? $user->getId();
        $newUser->password = Hash::make(Str::random());
        $newUser->save();

        return $newUser;
    }
}
