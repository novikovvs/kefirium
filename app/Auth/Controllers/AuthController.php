<?php

namespace App\Auth\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Auth\Actions\AuthByEmailAction;
use App\Http\Controllers\BaseController;
use App\Auth\Requests\AuthByEmailRequest;
use App\Auth\Actions\RegisterByEmailAction;
use App\Auth\Requests\RegisterByEmailRequest;
use App\Auth\Factories\RegisterByEmailFactory;

class AuthController extends BaseController
{
    public function email(AuthByEmailRequest $request, AuthByEmailAction $action): JsonResponse
    {
        return $this->success($action->execute($request->toArray()));
    }

    public function registerViaEmail(RegisterByEmailRequest $request, RegisterByEmailAction $action): JsonResponse
    {
        return $this->success($action->execute(RegisterByEmailFactory::fromRequest($request)));
    }

    public function logout(): JsonResponse
    {
        Auth::logout();

        return $this->success();
    }

    public function me(): JsonResponse
    {
        return $this->success(Auth::user());
    }
}
