<?php

namespace App\Auth\Actions;

use App\Users\Models\User;
use Illuminate\Http\Request;
use App\Users\Queries\UserQueries;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Users\Actions\CreateUserBySocialiteAction;

readonly class HandleGoogleCallbackAction
{
    public function __construct(
        private CreateUserBySocialiteAction $action,
        private UserQueries $userQueries,
    ) {
    }

    public function execute(Request $request): User
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $user = Socialite::driver('google')->stateless()->user();
        $existingUser = $this->userQueries->findByGoogleId($user->getId());
        $user = $existingUser ?? $this->action->execute($user);
        Auth::login($user, true);

        return $user;
    }
}
