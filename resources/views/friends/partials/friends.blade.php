<div>
    <h1 class="font-bold text-xl text-slate-600">
        Friends
    </h1>

    <div class="mt-4 space-y-3">

        @foreach($friends as $friend)
            {{ $friend->name }} ({{ $friend->email }})
        @endforeach

    </div>
</div>
