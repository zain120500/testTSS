<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        return Book::with('author')->get();
    }

    public function show($id)
    {
        return Book::with('author')->findOrFail($id);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'publish_date' => 'nullable|date',
            'author_id' => 'required|exists:authors,id',
        ]);

        return Book::create($validated);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'publish_date' => 'nullable|date',
            'author_id' => 'required|exists:authors,id',
        ]);

        $book->update($validated);
        return $book;
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->noContent();
    }

    public function booksByAuthor($id)
    {
        $author = Author::findOrFail($id);
        return $author->books; // Assuming relationship is defined
    }
}
