<?php

namespace App\Auth\Factories;

use Illuminate\Support\Facades\Hash;
use App\Auth\DTOs\RegisterByEmailDTO;
use App\Auth\Requests\RegisterByEmailRequest;

class RegisterByEmailFactory
{
    public static function fromRequest(RegisterByEmailRequest $request): RegisterByEmailDTO
    {
        return self::fromArray($request->toArray());
    }

    public static function fromArray(array $attributes): RegisterByEmailDTO
    {
        $instance = new RegisterByEmailDTO();
        $instance->email = $attributes['email'];
        $instance->name = $attributes['name'];
        $instance->hashedPassword = Hash::make($attributes['password']);
        $instance->password = $attributes['password'];

        return $instance;
    }
}
