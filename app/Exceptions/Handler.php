<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\AuthenticationException;
use App\Auth\Exceptions\FailedLoginException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [

    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        //        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     *
     * @throws Throwable
     */
    public function render($request, Throwable $e): JsonResponse|Response
    {
        if ($e instanceof ValidationException) {
            return new JsonResponse([
                'message' => $e->getMessage(),
                'data'    => $e->errors(),
            ], $e->getCode() ?: 422);
        }

        if ($e instanceof FailedLoginException) {
            return new JsonResponse([
                'message' => $e->getMessage(),
                'data'    => [],
            ], $e->getCode() ?: 401);
        }

        if ($e instanceof Throwable) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ]);
        }

        return parent::render($request, $e);
    }

    /**
     * Determine if the exception handler response should be JSON.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    protected function shouldReturnJson($request, Throwable $e): bool
    {
        return true;
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param  Request  $request
     */
    protected function unauthenticated($request, AuthenticationException $exception): JsonResponse
    {
        return new JsonResponse(['message' => $exception->getMessage()], 401);
    }
}
