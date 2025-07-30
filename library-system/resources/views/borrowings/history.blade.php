@extends('layouts.app')

@section('content')
<div class="flex justify-center items-start min-h-screen bg-gray-100 py-10 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg border border-gray-200 p-6">
        <h2 class="text-3xl font-bold text-center text-indigo-700 mb-6">Your Borrowing History</h2>

        @if ($borrowings->isEmpty())
            <div class="text-center text-gray-600 text-lg">
                <p>You have not borrowed any books yet.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse">
                    <thead class="bg-indigo-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-indigo-700 uppercase tracking-wider border-b">Book Title</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-indigo-700 uppercase tracking-wider border-b">Borrowed At</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-indigo-700 uppercase tracking-wider border-b">Returned At</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($borrowings as $borrowing)
                            <tr class="hover:bg-indigo-50 transition duration-200">
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap font-medium">{{ $borrowing->book->title }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $borrowing->borrowed_at->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 text-sm whitespace-nowrap">
                                    @if ($borrowing->returned_at)
                                        <span class="text-green-700 font-medium">{{ $borrowing->returned_at->format('Y-m-d') }}</span>
                                    @else
                                        <span class="text-yellow-600 italic">Not Returned</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
