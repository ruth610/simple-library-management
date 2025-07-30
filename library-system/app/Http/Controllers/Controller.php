<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\User;

abstract class Controller
{
    //

    public function studentBorrowings($id)
{
    $student = User::findOrFail($id);

    $active = Borrowing::with('book')
        ->where('user_id', $id)
        ->whereNull('returned_at')
        ->get();

    $history = Borrowing::with('book')
        ->where('user_id', $id)
        ->whereNotNull('returned_at')
        ->get();

    return view('borrowings.student', compact('student', 'active', 'history'));
}

public function return($id)
        {
            $borrow = Borrowing::findOrFail($id);
            $borrow->returned_at = now();
            $borrow->save();

            return back()->with('success', 'Book returned successfully.');
        }

}
