<?php

namespace App\Auth\Actions;

use App\Users\Models\User;
use App\Auth\DTOs\RegisterByEmailDTO;
use App\Auth\Exceptions\FailedLoginException;

readonly class RegisterByEmailAction
{
    public function __construct(
        private AuthByEmailAction $authAction,
    ) {
    }

    public function execute(RegisterByEmailDTO $DTO): ?User
    {
        $user = User::create([
            'name'     => $DTO->name,
            'email'    => $DTO->email,
            'password' => $DTO->hashedPassword,
        ]);

        if (! $this->authAction->execute(['email' => $DTO->email, 'password' => $DTO->password])) {
            throw new FailedLoginException();
        }

        return $user;
    }
}
