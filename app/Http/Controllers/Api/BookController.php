<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all books from the database
        $books = Book::orderBy('title', 'asc')->get();

        // Return the books as a JSON response
        return response()->json([
            'success' => true,
            'message' => 'Data buku berhasil diambil.',
            'data' => $books,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch a specific book from the database
        $book = Book::findOrFail($id);

        // Return the book as a JSON response
        if ($book) {
            return response()->json([
                'success' => true,
                'message' => "Data buku berhasil diambil.",
                'data' => $book
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Data buku tidak ditemukan.",
                'data' => null
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
