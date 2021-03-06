<x-layouts.app>

    <x-slot name="header">Sign up</x-slot>

    <form action="/register" method="post" class="mt-4 space-y-4" >
        @csrf

        <div class="space-y-1">
            <label for="name" class="block">Your name</label>
            <input type="text" name="name" id="name" placeholder="e.g. Mabel" class="rounded block w-full" />
            @error('name')
                <div class="text-xs text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <div class="space-y-1">
            <label for="email" class="block">Email address</label>
            <input type="email" name="email" id="email" placeholder="e.g. you@example.com" class="rounded block w-full" />
            @error('email')
                <div class="text-xs text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <div class="space-y-1">
            <label for="password" class="block">Password</label>
            <input type="password" name="password" id="password" class="rounded block w-full" />
            @error('password')
                <div class="text-xs text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="bg-slate-200 hover:bg-slate-300 px-3 py-2 rounded">
            Create account
        </button>
    </form>

</x-layouts.app>
