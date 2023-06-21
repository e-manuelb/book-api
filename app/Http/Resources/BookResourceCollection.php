<?php

namespace App\Http\Resources;

use App\Http\Resources\Helpers\FormatBookResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class BookResourceCollection extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return Collection
     */
    public function toArray(Request $request): Collection
    {
        return $this->resource->map(function ($item) {
            return FormatBookResponse::execute($item);
        });
    }
}
