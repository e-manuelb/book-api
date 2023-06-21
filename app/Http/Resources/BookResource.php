<?php

namespace App\Http\Resources;

use App\Http\Resources\Helpers\FormatBookResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return FormatBookResponse::execute($this);
    }
}
