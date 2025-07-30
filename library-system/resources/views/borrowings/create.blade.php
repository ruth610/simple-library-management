@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
            Borrow Book for <span class="text-blue-600">{{ $student->name }}</span>
        </h2>

        {{-- Show success or error messages --}}
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('borrowings.store') }}" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" name="student_id" value="{{ $student->id }}">

            <div class="text-center">
                <label for="book_id" class="block text-sm font-medium text-gray-700 mb-1">Select Book:</label>
                <select name="book_id" id="book_id"
                    class="mx-auto w-3/4 rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-center"
                    required>
                    <option value="" disabled selected>Choose a book</option>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}">{{ $book->title }} by {{ $book->author }}</option>
                    @endforeach
                </select>
                @error('book_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col items-center space-y-3">
                <button type="submit"
                    class="w-3/4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-200">
                    Borrow Book
                </button>
                <a href="{{ route('students.index') }}"
                    class="w-3/4 px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition duration-200 text-center">
                    Back
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
