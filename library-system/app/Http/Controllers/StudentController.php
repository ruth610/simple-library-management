<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;

class StudentController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware(['auth', 'role:admin|librarian']); 
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'student_id'=> 'required|string|max:255',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'student_id'=>$validated['student_id'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole('student');

        return redirect()->back()->with('success', 'Student registered successfully!');
    }
}
