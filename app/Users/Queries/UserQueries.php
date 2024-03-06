<?php

namespace App\Users\Queries;

use App\Users\Models\User;

class UserQueries
{
    public function findByGoogleId(string $googleId)
    {
        return User::where('google_id', $googleId)->first();
    }
}
