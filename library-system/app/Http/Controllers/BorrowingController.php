<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $students = User::role('student')->get();
        // dd($students);
        return view('borrowings.students', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $student)
    {
        $books = Book::all();
        return view('borrowings.create', compact('student', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
        ]);

        $exists = Borrowing::where('user_id', $validated['student_id'])
            ->where('book_id', $validated['book_id'])
            ->whereNull('returned_at') // prevent duplicates
            ->exists();

        if ($exists) {
            return back()->with('error', 'This book is already borrowed by this student.');
        }
        $book = Book::findOrFail($validated['book_id']);

        if ($book->stock <= 0) {
        return back()->with('error', 'This book is currently out of stock.');
        }

        Borrowing::create([
        'user_id' => $validated['student_id'],
        'book_id' => $validated['book_id'],
        'borrowed_at' => now(),
        ]);

        

        $book->decrement('stock');

    return redirect()->route('students.index')->with('success', 'Book borrowed successfully.');
}

   public function returnBook($id)
{
    $borrow = Borrowing::with('book')->findOrFail($id);
    if ($borrow->returned_at !== null) {
        return back()->with('info', 'Book was already returned.');
    }

    // Make sure the book exists
    $book = $borrow->book; // Assuming Borrowing model has `book()` relationship

    // Mark as returned
    $borrow->update(['returned_at' => now()]);

    // Increase book stock
    if ($book) {
        $book->increment('stock');
    }
    

    return redirect()->route('borrowings.index')->with('success', 'Book returned successfully!');
}



    /**
     * Display the specified resource.
     */
    public function show($id)
        {
            $student = User::findOrFail($id);

            // Get borrowing records for this student (if any)
            $borrowings = Borrowing::where('user_id', $student->id)->with('book')->get();

            return view('borrowings.show', compact('student', 'borrowings'));
        }


    
    public function list()
        {
            $borrowings = Borrowing::with(['user', 'book'])->get();
            return view('borrowings.index', compact('borrowings'));
        }

    public function userHistory()
        {
            $borrowings = Borrowing::with('book')
                ->where('user_id', Auth::id())
                ->orderBy('borrowed_at', 'desc')
                ->get();

            return view('borrowings.history', compact('borrowings'));
        }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
