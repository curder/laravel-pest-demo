<div>
    <h1 class="font-bold text-xl text-slate-600">
        Friends
    </h1>

    <div class="mt-4 space-y-3">

        @foreach($friends as $friend)
            {{ $friend->name }} ({{ $friend->email }})

            <form action="/friends/{{ $friend->id }}" method="post" class="inline">
                @csrf
                @method('DELETE')

                <button type="submit" class="text-red-500 hover:text-red-600">Delete</button>
            </form>
        @endforeach

    </div>
</div>
