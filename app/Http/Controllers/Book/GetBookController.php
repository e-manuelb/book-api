<?php

namespace App\Http\Controllers\Book;

use App\Domain\Features\Book\GetBook;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Services\Book\GetBookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class GetBookController extends Controller
{
    private GetBook $getBookService;

    /**
     * @param GetBook $getBookService
     */
    public function __construct(GetBook $getBookService)
    {
        $this->getBookService = $getBookService;
    }

    public function __invoke(int $id): JsonResponse
    {
        /** @var Book $book */
        $book = $this->getBookService->handle($id);

        if (!$book) {
            return response()->json([
                'message' => "Book with ID #$id was not found."
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json(new BookResource($book));
    }
}
