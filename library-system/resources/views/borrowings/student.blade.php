<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Borrowings for {{ $student->name }}</h2>
    </x-slot>

    <div class="py-6 px-4">
        <h3 class="text-lg mb-2">📚 Currently Borrowed:</h3>
        <ul>
            @foreach($active as $borrow)
                <li>
                    {{ $borrow->book->title }}
                    <form action="{{ route('borrowings.return', $borrow->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="text-green-600 ml-2">Mark as Returned</button>
                    </form>
                </li>
            @endforeach
        </ul>

        <h3 class="text-lg mt-6 mb-2">📖 Borrow History:</h3>
        <ul>
            @foreach($history as $borrow)
                <li>{{ $borrow->book->title }} (Returned: {{ $borrow->returned_at->format('Y-m-d') }})</li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
