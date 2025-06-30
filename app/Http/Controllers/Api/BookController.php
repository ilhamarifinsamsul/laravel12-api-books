<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

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
        $books = new Book;

        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'pengarang' => 'required',
            'tanggal_terbit' => 'required|date',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memasukkan data.',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $books->title = $request->title;
        $books->pengarang = $request->pengarang;
        $books->tanggal_terbit = $request->tanggal_terbit;
        $books->save();

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil ditambahkan.',
            'data' => $books
        ], 201);

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
        $books = Book::findOrFail($id);

        if (empty($books)) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan.',
                'data' => null
            ], 404);
        }

        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'pengarang' => 'required',
            'tanggal_terbit' => 'required|date',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal melakukan update data.',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $books->title = $request->title;
        $books->pengarang = $request->pengarang;
        $books->tanggal_terbit = $request->tanggal_terbit;
        $books->save();

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Sukses melakukan update data.',
            
        ], 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Fetch the book to be deleted
        $book = Book::findOrFail($id);

        // delete the book
        $book->delete();

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil dihapus.',
            'data' => null
        ], 200);
        
    }
}
