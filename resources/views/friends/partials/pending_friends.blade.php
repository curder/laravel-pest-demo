<div>
    <h1 class="font-bold text-xl text-slate-600">
        Pending friend request
    </h1>

    <div class="mt-4 space-y-3">

        @foreach($pending_friends as $pending_friend)
            <div>
                {{ $pending_friend->name }} ({{ $pending_friend->email }})

                <form action="/friends/{{ $pending_friend->id }}" method="post" class="inline">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="text-blue-500 hover:text-blue-600">Cancel</button>
                </form>
            </div>
        @endforeach

    </div>
</div>
