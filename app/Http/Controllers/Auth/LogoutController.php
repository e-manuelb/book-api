<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Features\Auth\Logout;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LogoutController
{
    private Logout $logoutService;

    /**
     * @param Logout $logoutService
     */
    public function __construct(Logout $logoutService)
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
