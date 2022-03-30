<x-layouts.app>
    @guest
        <x-slot name="header">Bookfriends</x-slot>

        <div class="mt-6">
            Sign up to get started.
        </div>
    @endguest

    @auth

        <x-slot name="header">My Books</x-slot>

        <div class="space-y-6">
            @foreach($books_by_status as $status => $books)
                <div>
                    <h1 class="font-bold text-xl text-slate-600">
                        {{ \App\Models\Pivot\BookUser::$statuses[$status] }}
                    </h1>

                    <div class="mt-4 space-y-3">
                        @foreach($books as $book)
                            <x-book :book="$book">
                                <x-slot name="links">
                                    <a class="text-blue-500 hover:text-blue-600 text-sm" href="{{ route('books.edit', $book) }}">Edit</a>
                                </x-slot>
                            </x-book>
                        @endforeach

                    </div>
                </div>
            @endforeach
        </div>

    @endauth

</x-layouts.app>
