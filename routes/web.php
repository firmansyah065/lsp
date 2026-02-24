<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;

// Halaman Login
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'authenticate']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registrasi Siswa
Route::get('/register', [UserController::class, 'showRegister'])->name('register');
Route::post('/register', [UserController::class, 'register']);

// Admin Routes
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('dashboard.admin');
    })->name('admin.dashboard');

    // Books Management
    Route::resource('books', BookController::class);

    // Transactions Management
    Route::get('/transactions', [TransactionController::class, 'indexAdmin'])->name('transactions.index.admin');
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/{transaction}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
    Route::put('/transactions/{transaction}', [TransactionController::class, 'update'])->name('transactions.update');
    Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');

    // Members Management
    Route::get('/members', [UserController::class, 'indexMembers'])->name('members.index');
    Route::get('/members/create', [UserController::class, 'createMember'])->name('members.create');
    Route::post('/members', [UserController::class, 'storeMember'])->name('members.store');
    Route::get('/members/{user}/edit', [UserController::class, 'editMember'])->name('members.edit');
    Route::put('/members/{user}', [UserController::class, 'updateMember'])->name('members.update');
    Route::delete('/members/{user}', [UserController::class, 'destroyMember'])->name('members.destroy');
});

// Student Routes
Route::middleware(['auth', 'is_siswa'])->prefix('student')->group(function () {
    // Dashboard Siswa
    Route::get('/dashboard', function () {
        return view('dashboard.siswa');
    })->name('student.dashboard');

    // Borrowing
    Route::post('/borrow', [TransactionController::class, 'borrowBook'])->name('borrow');
    Route::get('/borrowings', [TransactionController::class, 'getStudentBorrowings'])->name('borrowings');
    
    // Returns
    Route::get('/pengembalian', function () {
        return view('student.pengembalian');
    })->name('pengembalian');
    Route::post('/return', [TransactionController::class, 'returnBook'])->name('return');
});

// Redirect after login based on role
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/student/dashboard');
        }
    });

    Route::get('/dashboard/admin', function () {
        return redirect('/admin/dashboard');
    });

    Route::get('/dashboard/siswa', function () {
        return redirect('/student/dashboard');
    });
});
