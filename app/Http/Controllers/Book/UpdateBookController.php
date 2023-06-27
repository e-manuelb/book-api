<?php

namespace App\Http\Controllers\Book;

use App\Domain\Features\Book\UpdateBook;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\BookResource;
use Illuminate\Http\JsonResponse;

class UpdateBookController
{
    private UpdateBook $updateBookService;

    /**
     * @param UpdateBook $updateBookService
     */
    public function __construct(UpdateBook $updateBookService)
    {
        $this->updateBookService = $updateBookService;
    }

    public function __invoke(int $id, UpdateBookRequest $request): JsonResponse
    {
        return response()->json(new BookResource($this->updateBookService->handle($id, $request->validated())));
    }
}
