<?php

namespace App\Http\Resources\Helpers;

class FormatBookResponse
{
    public static function execute($book): array
    {
        return [
            'id' => $book->id,
            'name' => $book->name,
            'isbn' => $book->isbn,
            'value' => $book->value,
            'created_at' => $book->created_at,
            'updated_at' => $book->updated_at,
            '_links' => [
                [
                    'rel' => 'self',
                    'type' => 'GET',
                    'href' => route('book.show', ['id' => $book->id])
                ],
                [
                    'rel' => 'update',
                    'type' => 'PUT',
                    'href' => route('book.update', ['id' => $book->id])
                ],
                [
                    'rel' => 'delete',
                    'type' => 'DELETE',
                    'href' => route('book.delete', ['id' => $book->id])
                ]
            ]
        ];
    }
}
