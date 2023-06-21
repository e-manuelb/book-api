<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\LoginService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LoginController
{
    private LoginService $loginService;

    /**
     * @param LoginService $loginService
     */
    public function __construct(LoginService $loginService)
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
