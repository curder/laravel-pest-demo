<div>
    <h1 class="font-bold text-xl text-slate-600">
        Friends
    </h1>

    <div class="mt-4 space-y-3">

        @foreach($friends as $friend)
            {{ $friend->name }} ({{ $friend->email }})

            <form action="/friends/{{ $friend->id }}" method="post">
                @csrf
                @method('DELETE')

                <button type="submit" class="text-blue-500 hover:text-blue-600">Delete</button>
            </form>
        @endforeach

    </div>
</div>
