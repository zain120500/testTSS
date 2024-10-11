<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

Route::apiResource('authors', AuthorController::class);
Route::apiResource('books', BookController::class);
Route::get('authors/{id}/books', [BookController::class, 'booksByAuthor']);
