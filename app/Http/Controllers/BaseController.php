<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class BaseController
{
    public function success(mixed $data = [], string $message = '', int $status = 200): JsonResponse
    {
        return new JsonResponse([
            'result'  => $data,
            'message' => $message,
        ], $status);
    }
}
