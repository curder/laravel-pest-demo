<div>
    <h1 class="font-bold text-xl text-slate-600">
        Friend requests
    </h1>

    <div class="mt-4 space-y-3">

        @foreach($requesting_friends as $requesting_friend)
            {{ $requesting_friend->name }} ({{ $requesting_friend->email }})

            <form action="/friends/{{ $requesting_friend->id }}" method="post">
                @csrf
                @method('PATCH')

                <button type="submit" class="text-blue-500 hover:text-blue-600">Accept</button>
            </form>
        @endforeach

    </div>
</div>
