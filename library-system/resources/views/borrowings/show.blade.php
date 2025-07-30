@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Borrowing History for {{ $student->name }}</h2>

    @if($borrowings->isEmpty())
        <p class="text-gray-600">This student has no borrowing records.</p>
    @else
        <table class="w-full border rounded">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2">Book Title</th>
                    <th class="p-2">Borrowed At</th>
                    <th class="p-2">Returned At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrowings as $borrowing)
                    <tr class="border-t">
                        <td class="p-2">{{ $borrowing->book->title ?? 'N/A' }}</td>
                        <td class="p-2">{{ $borrowing->borrowed_at }}</td>
                        <td class="p-2">{{ $borrowing->returned_at ?? 'Not returned yet' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
