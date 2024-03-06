<?php

namespace App\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthByEmailRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email'    => 'string|required',
            'password' => 'string|required',
        ];
    }
}
