<?php

namespace App\Http\Controllers\Book;

use App\Domain\Features\Book\SaveBook;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\SaveBookRequest;
use App\Http\Resources\BookResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SaveBookController extends Controller
{
    private SaveBook $saveBookService;

    /**
     * @param SaveBook $saveBookService
     */
    public function __construct(SaveBook $saveBookService)
    {
        $this->saveBookService = $saveBookService;
    }

    public function __invoke(SaveBookRequest $request): JsonResponse
    {

        return response()->json(new BookResource($this->saveBookService->handle($request->validated())), Response::HTTP_CREATED);
    }
}
