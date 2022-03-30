<div>
    <h1 class="font-bold text-xl text-slate-600">
        Pending friend request
    </h1>

    <div class="mt-4 space-y-3">

        @foreach($pending_friends as $pending_friend)
            {{ $pending_friend->name }}
        @endforeach

    </div>
</div>
