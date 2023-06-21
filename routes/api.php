<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Book\DeleteBookController;
use App\Http\Controllers\Book\GetBookController;
use App\Http\Controllers\Book\ListBooksController;
use App\Http\Controllers\Book\SaveBookController;
use App\Http\Controllers\Book\UpdateBookController;
use App\Http\Controllers\User\SaveUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Open routes
Route::post('/register', SaveUserController::class);

Route::post('/login', LoginController::class);

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/logout', LogoutController::class);

    Route::prefix('book')->group(function () {
        Route::post('/', SaveBookController::class);
        Route::get('/', ListBooksController::class);
        Route::get('/{id}', GetBookController::class)->name('book.show');
        Route::put('/{id}', UpdateBookController::class)->name('book.update');
        Route::delete('/{id}', DeleteBookController::class)->name('book.delete');
    });
});
