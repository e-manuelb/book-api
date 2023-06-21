<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\SaveUserRequest;
use App\Services\User\SaveUserService;
use Illuminate\Http\JsonResponse;

class SaveUserController
{
    private SaveUserService $saveUserService;

    /**
     * @param SaveUserService $saveUserService
     */
    public function __construct(SaveUserService $saveUserService)
    {
        $this->saveUserService = $saveUserService;
    }

    public function __invoke(SaveUserRequest $request): JsonResponse
    {
        return response()->json($this->saveUserService->handle($request->validated()));
    }
}
