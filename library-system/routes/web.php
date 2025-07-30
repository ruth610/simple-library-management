<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin|librarian'])->group(function () {
    // Book & category management
    Route::resource('books', BookController::class);
    Route::resource('categories', CategoryController::class);

    // Student registration
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');

    // Borrowing routes
    Route::get('/students', [BorrowingController::class, 'index'])->name('students.index');
    Route::get('/borrowings/create/{student}', [BorrowingController::class, 'create'])->name('borrowings.create');
    Route::post('/borrowings/store', [BorrowingController::class, 'store'])->name('borrowings.store');
    Route::get('/borrowings', [BorrowingController::class, 'list'])->name('borrowings.index');
    Route::post('/borrowings/return/{id}', [BorrowingController::class, 'returnBook'])->name('borrowings.returnBook');
});
Route::get('/borrowings/history', [BorrowingController::class, 'userHistory'])
    ->name('borrowings.history')
    ->middleware('auth');

require __DIR__.'/auth.php';

