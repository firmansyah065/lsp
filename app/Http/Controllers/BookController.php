<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the books
     */
    public function index()
    {
        $books = Book::all();
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new book
     */
    public function create()
    {
        return view('admin.books.create');
    }

    /**
     * Store a newly created book in the database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_buku' => 'required|unique:books|string|max:255',
            'judul_buku' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
        ]);

        Book::create($validated);

        return redirect()->route('books.index')
                       ->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified book
     */
    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    /**
     * Update the specified book in the database
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'kode_buku' => 'required|unique:books,kode_buku,' . $book->id . '|string|max:255',
            'judul_buku' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
        ]);

        $book->update($validated);

        return redirect()->route('books.index')
                       ->with('success', 'Buku berhasil diperbarui!');
    }

    /**
     * Delete the specified book from the database
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
                       ->with('success', 'Buku berhasil dihapus!');
    }
}
