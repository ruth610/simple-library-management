@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Add Student
    </h2>
@endsection

@section('content')
<div class="max-w-2xl mx-auto px-6 py-10 bg-white rounded-md shadow-md mt-6">
    <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Register New Student</h2>

    @if(session('success'))
        <div class="mb-4 text-green-700 bg-green-100 border border-green-300 rounded px-4 py-2">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('students.store') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-1">Name</label>
            <input type="text" name="name" id="name"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
            <input type="email" name="email" id="email"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>

        <div class="mb-4">
            <label for="student_id" class="block text-gray-700 font-medium mb-1">Student ID</label>
            <input type="text" name="student_id" id="student_id"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
            <input type="password" name="password" id="password"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block text-gray-700 font-medium mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>

        <button type="submit"
            class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200">
            Register Student
        </button>
    </form>
</div>
@endsection
