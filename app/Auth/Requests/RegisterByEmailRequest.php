<?php

namespace App\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterByEmailRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:250',
            'email'    => 'required|email|max:250|unique:users',
            'password' => 'required|min:8',
        ];
    }
}
