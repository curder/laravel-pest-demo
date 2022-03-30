<x-layouts.app>

    <x-slot name="header">
        Friends
    </x-slot>

    <div class="space-y-6">

        @include('friends.partials.add_friend')

        @includeWhen($pending_friends->isNotEmpty(), 'friends.partials.pending_friends')

        @includeWhen($requesting_friends->isNotEmpty(), 'friends.partials.requesting_friends')

        @includeWhen($friends->isNotEmpty(), 'friends.partials.friends')

    </div>
</x-layouts.app>
