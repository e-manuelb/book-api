<?php

namespace App\Http\Controllers\Book;

use App\Http\Resources\BookResourceCollection;
use App\Services\Book\ListBooksService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class ListBooksController
{
    private ListBooksService $listBooksService;

    /**
     * @param ListBooksService $listBooksService
     */
    public function __construct(ListBooksService $listBooksService)
    {
        $this->listBooksService = $listBooksService;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $perPage = $request->input('perPage', 30);
        $page = $request->input('page');

        $books = $this->listBooksService->list();

        $formattedBooks = new BookResourceCollection($books);

        return response()->json($this->paginate($formattedBooks, $perPage, $page));
    }

    private function paginate($items, int $perPage, int $page = null): LengthAwarePaginator
    {
        $options = [];

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
