@extends('layouts.app') {{-- Or whatever layout your dashboard uses --}}

@section('content')
<div class="flex justify-center items-start min-h-screen bg-gray-50 pt-10 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-6xl bg-white shadow-2xl rounded-xl overflow-hidden border border-gray-200">
        <div class="px-6 py-4">
            <h2 class="text-3xl font-bold text-center text-indigo-700 mb-6">Borrowed Books</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse">
                    <thead class="bg-indigo-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-indigo-700 uppercase tracking-wider border-b">Student</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-indigo-700 uppercase tracking-wider border-b">Book</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-indigo-700 uppercase tracking-wider border-b">Borrowed At</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-indigo-700 uppercase tracking-wider border-b">Return Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($borrowings as $borrowing)
                            <tr class="hover:bg-indigo-50 transition duration-200">
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap font-medium">{{ $borrowing->user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">{{ $borrowing->book->title }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $borrowing->borrowed_at }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">
                                    @if (is_null($borrowing->returned_at))
                                        <form action="{{ route('borrowings.returnBook', $borrowing->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to mark this book as returned?')">
                                            @csrf
                                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-1 rounded-md shadow text-sm transition duration-150">
                                                Return
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-500 italic">Returned at {{ $borrowing->returned_at->format('Y-m-d') }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
