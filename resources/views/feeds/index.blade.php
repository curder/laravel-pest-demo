<x-layouts.app>
    <x-slot name="header">
        Feed
    </x-slot>

    <div class="space-y-6">
        @foreach($books as $book)
            <div>
                <div class="mb-2">
                    {{ $book->user->first()->name }} {{ $book->book_user->action }} {{ $book->title }}
                </div>

                <x-book :book="$book"></x-book>
            </div>
        @endforeach
    </div>

</x-layouts.app>
