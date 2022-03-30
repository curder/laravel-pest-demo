<div>
    <h1 class="font-bold text-xl text-slate-600">
        Add a Friend
    </h1>

    <div class="mt-4 space-y-3">
        <form action="/friends" method="post" class="space-y-4">
            @csrf

            <div class="space-y-1">
                <label for="email" class="block">Email address</label>
                <input type="email" name="email" id="email" placeholder="e.g. you@example.com" class="rounded block w-full" />
            </div>

            <button type="submit" class="bg-slate-200 hover:bg-slate-300 px-3 py-2 rounded">
                Send request
            </button>

        </form>

    </div>
</div>
