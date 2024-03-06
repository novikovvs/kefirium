<?php

namespace App\Auth\DTOs;

class RegisterByEmailDTO
{
    public string $name;

    public string $email;

    public string $hashedPassword;

    public string $password;
}
