<div>
    <h1 class="font-bold text-xl text-slate-600">
        Friend requests
    </h1>

    <div class="mt-4 space-y-3">

        @foreach($requesting_friends as $requesting_friend)
            {{ $requesting_friend->name }}
        @endforeach

    </div>
</div>
