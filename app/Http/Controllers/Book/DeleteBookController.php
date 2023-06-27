<?php

namespace App\Http\Controllers\Book;

use App\Domain\Features\Book\DeleteBook;
use App\Services\Book\DeleteBookService;
use App\Services\Book\GetBookService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class DeleteBookController
{
    private DeleteBook $deleteBookService;

    /**
     * @param DeleteBook $deleteBookService
     */
    public function __construct(DeleteBook $deleteBookService)
    {
        $this->deleteBookService = $deleteBookService;
    }

    public function __invoke(int $id): JsonResponse
    {
        try {
            $this->deleteBookService->handle($id);
        } catch (Exception $exception) {
            return response()->json([
                'message' => "Book with ID #$id cannot be deleted. Error: {$exception->getMessage()}."
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'message' => "Book with ID #$id deleted successfully."
        ]);
    }
}
