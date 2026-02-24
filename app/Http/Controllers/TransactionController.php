<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display transaction history (Admin)
     */
    public function indexAdmin()
    {
        $transactions = Transaction::with(['user', 'book'])
                                  ->orderBy('tanggal_pinjam', 'desc')
                                  ->get();
        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Show form for creating new transaction (Admin)
     */
    public function create()
    {
        $users = User::where('role', 'siswa')->get();
        $books = Book::where('is_available', true)->get();
        return view('admin.transactions.create', compact('users', 'books'));
    }

    /**
     * Store a new transaction (Admin)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'tanggal_pinjam' => 'required|date',
            'status' => 'required|in:pinjam,kembali',
        ]);

        // Check if book is available
        $book = Book::find($validated['book_id']);
        if (!$book->is_available) {
            return back()->with('error', 'Buku tidak tersedia untuk dipinjam!');
        }

        // Create transaction
        Transaction::create($validated);

        // Update book availability
        $book->update(['is_available' => false]);

        return redirect()->route('transactions.index.admin')
                       ->with('success', 'Transaksi berhasil dibuat!');
    }

    /**
     * Show form for editing transaction
     */
    public function edit(Transaction $transaction)
    {
        $users = User::where('role', 'siswa')->get();
        $books = Book::all();
        return view('admin.transactions.edit', compact('transaction', 'users', 'books'));
    }

    /**
     * Update transaction (Admin)
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_pinjam',
            'status' => 'required|in:pinjam,kembali',
        ]);

        // If marking as returned, update book availability
        if ($validated['status'] === 'kembali' && $transaction->status === 'pinjam') {
            $transaction->book->update(['is_available' => true]);
        }

        $transaction->update($validated);

        return redirect()->route('transactions.index.admin')
                       ->with('success', 'Transaksi berhasil diperbarui!');
    }

    /**
     * Delete transaction
     */
    public function destroy(Transaction $transaction)
    {
        // Jika transaksi masih pinjam, kembalikan availability buku
        if ($transaction->status === 'pinjam') {
            $transaction->book->update(['is_available' => true]);
        }

        $transaction->delete();

        return redirect()->route('transactions.index.admin')
                       ->with('success', 'Transaksi berhasil dihapus!');
    }

    /**
     * Student borrow book
     */
    public function borrowBook(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::find($validated['book_id']);

        if (!$book->is_available) {
            return back()->with('error', 'Buku sedang tidak tersedia!');
        }

        // Create transaction
        Transaction::create([
            'user_id' => Auth::id(),
            'book_id' => $validated['book_id'],
            'tanggal_pinjam' => Carbon::now()->toDateString(),
            'status' => 'pinjam',
        ]);

        // Update book availability
        $book->update(['is_available' => false]);

        return back()->with('success', 'Buku berhasil dipinjam!');
    }

    /**
     * Student return book
     */
    public function returnBook(Request $request)
    {
        $validated = $request->validate([
            'transaction_id' => 'required|integer|exists:transactions,id',
        ]);

        $transaction = Transaction::find($validated['transaction_id']);

        // Check if transaction exists
        if (!$transaction) {
            return back()->with('error', 'Transaksi tidak ditemukan!');
        }

        // Verify ownership
        if ($transaction->user_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak berhak mengembalikan transaksi ini!');
        }

        // Check if already returned
        if ($transaction->status === 'kembali') {
            return back()->with('error', 'Buku ini sudah dikembalikan sebelumnya!');
        }

        // Update transaction
        $transaction->update([
            'tanggal_kembali' => Carbon::now()->toDateString(),
            'status' => 'kembali',
        ]);

        // Update book availability
        $transaction->book->update(['is_available' => true]);

        return back()->with('success', 'Buku berhasil dikembalikan!');
    }

    /**
     * Get student's active borrowings
     */
    public function getStudentBorrowings()
    {
        $borrowings = Transaction::where('user_id', Auth::id())
                                ->where('status', 'pinjam')
                                ->with('book')
                                ->get();
        return view('student.borrowings', compact('borrowings'));
    }
}
