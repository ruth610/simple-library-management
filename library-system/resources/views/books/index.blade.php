@extends('layouts.app')

@section('content')
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- Heading --}}
            <h1 class="text-2xl font-bold text-gray-800">Books Management</h1>

            {{-- Add Book Form --}}
            <div class="p-6 bg-white rounded-lg shadow">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Add New Book</h2>
                <form action="{{ route('books.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-gray-600 mb-1">Title</label>
                        <input type="text" name="title" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" required>
                    </div>

                    <div>
                        <label class="block text-gray-600 mb-1">Author</label>
                        <input type="text" name="author" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" required>
                    </div>

                    <div>
                        <label class="block text-gray-600 mb-1">Category</label>
                        <select name="category_id" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" required>
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-600 mb-1">Stock</label>
                        <input type="number" name="stock" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" required>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
                        Add Book
                    </button>
                </form>
            </div>

            {{-- Books Table --}}
            <div class="bg-white rounded-lg shadow overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-6 py-3">Title</th>
                            <th class="px-6 py-3">Author</th>
                            <th class="px-6 py-3">Category</th>
                            <th class="px-6 py-3">Stock</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-6 py-3">{{ $book->title }}</td>
                                <td class="px-6 py-3">{{ $book->author }}</td>
                                <td class="px-6 py-3">{{ $book->category->name ?? 'N/A' }}</td>
                                <td class="px-6 py-3">{{ $book->stock }}</td>
                                <td class="px-6 py-3 space-x-2">
                                    <a href="{{ route('books.edit', $book) }}" class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center px-6 py-4 text-gray-500">No books found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
