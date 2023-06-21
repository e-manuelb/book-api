<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Services\Auth\LogoutService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LogoutController
{
    private LogoutService $logoutService;

    /**
     * @param LogoutService $logoutService
     */
    public function __construct(LogoutService $logoutService)
    {
        $this->logoutService = $logoutService;
    }

    public function __invoke(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();

        $this->logoutService->handle($user);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
