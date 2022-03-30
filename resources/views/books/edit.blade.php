<x-layouts.app>

    <x-slot name="header">Edit book</x-slot>

    <form action="/books" method="post" class="mt-4 space-y-4" >
        @csrf

        <div class="space-y-1">
            <label for="title" class="block">Title</label>
            <input type="text" name="title" id="title" class="rounded block w-full" value="{{ old('title', $book->title) }}" />
            @error('title')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="space-y-1">
            <label for="author" class="block">Author</label>
            <input type="text" name="author" id="author" class="rounded block w-full" value="{{ old('author', $book->author) }}" />
            @error('author')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="space-y-1">
            <label for="status" class="block">Status</label>
            <select name="status" id="status" class="form-select">
                @foreach(\App\Models\Pivot\BookUser::$statuses as $key => $value)
                    <option value="{{ $key }}"{{ $book->pivot->status === $key ? ' selected': '' }}>{{ $value }}</option>
                @endforeach
            </select>
            @error('status')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="bg-slate-200 hover:bg-slate-300 px-3 py-2 rounded">
            Edit book
        </button>
    </form>

</x-layouts.app>
