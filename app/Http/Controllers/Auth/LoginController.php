<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Features\Auth\Login;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LoginController
{
    private Login $loginService;

    /**
     * @param Login $loginService
     */
    public function __construct(Login $loginService)
    {
        $this->loginService = $loginService;
    }

    public function __invoke(LoginRequest $request): JsonResponse
    {
        $serviceResponse = $this->loginService->handle($request->validated());

        if ($serviceResponse == "Invalid credentials.") {
            return response()->json(['message' => $serviceResponse], Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            return response()->json(['token' => $serviceResponse]);
        }
    }
}
