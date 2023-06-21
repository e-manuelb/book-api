<?php

namespace App\Http\Controllers\Book;

use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Services\Book\UpdateBookService;
use Illuminate\Http\JsonResponse;

class UpdateBookController
{
    private UpdateBookService $updateBookService;

    /**
     * @param UpdateBookService $updateBookService
     */
    public function __construct(UpdateBookService $updateBookService)
    {
        $this->updateBookService = $updateBookService;
    }

    public function __invoke(int $id, UpdateBookRequest $request): JsonResponse
    {
        return response()->json(new BookResource($this->updateBookService->handle($id, $request->validated())));
    }
}
