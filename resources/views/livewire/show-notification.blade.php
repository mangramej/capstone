<div x-data="{ notification: false }" class="relative w-full">
    <button x-on:click="notification = !notification"
        class="block shrink-0 rounded-lg bg-white p-2.5 text-gray-600 shadow-sm hover:text-gray-700"
    >
        <div class="relative">
            <x-icon name="bell" class="w-6 h-6"/>

            @if(count($notifications) > 0)
                <div class="absolute top-0 right-0 w-3 h-3 bg-red-600 rounded-full">
                </div>
            @endif
        </div>
    </button>

    <div
        x-cloak
        x-show="notification"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        x-on:click.away="notification = false"
        x-on:keydown.escape.window="notification = false"
        class="absolute right-0 z-10 mt-2 w-96 h-96 overflow-y-auto origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
        role="menu" aria-orientation="vertical" aria-labelledby="notification-menu-button" tabindex="-1">

        <div class="divide-y">
            <div class="px-4 py-2 text-sm text-gray-700 flex justify-between items-center">
                <span class="font-medium">
                    Notifications ({{ count($notifications) }})
                </span>

                <button type="button" class="text-sky-600 hover:text-sky-500 hover:underline"
                    wire:click="markAllAsRead"
                >
                    Mark all sa read
                </button>
            </div>

            @forelse($notifications as $el)
                <a
                    wire:click="markAsRead({{ $el }})"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                    role="menuitem"
                    tabindex="-1"
                >
                    @if($el->data['type'] == 'milk-request')
                        <span>Milk Request: <b>{{ $el->data['milk_request']['ref_number'] }}</b></span> <br>
                    @endif

                    <span class="text-gray-600 text-xs">{{ $el->data['message'] }}</span> <br>
                    <span class="mt-2 text-gray-400 text-xs">
                        {{ $el->created_at->diffForHumans() }}
                    </span>
                </a>
            @empty
                <div class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">
                    No new notification
                </div>
            @endforelse
        </div>
    </div>
</div>
