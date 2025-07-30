@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">📚 Categories</h2>

    <!-- Add new category form -->
    <form action="{{ route('categories.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md mb-8">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
            <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-200" required>
        </div>
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">Add Category</button>
    </form>

    <!-- List of categories -->
    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full table-auto text-sm text-left text-gray-600">
            <thead class="bg-indigo-50">
                <tr>
                    <th class="px-6 py-3 font-semibold text-gray-700">Name</th>
                    <th class="px-6 py-3 font-semibold text-gray-700">Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $category->name }}</td>
                        <td class="px-6 py-4">{{ $category->created_at->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-center text-gray-500">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
