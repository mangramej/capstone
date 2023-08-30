<nav class="bg-white shadow rounded-xl text-gray-700 w-full">
    <div class="flex justify-between items-center px-6">
        <a href="{{ route('admin.dashboard') }}" class="">
            <x-logo size="10"/>
        </a>

        <div class="inline-flex items-center">
            <x-bz.dropdown align="right">
                <x-slot name="trigger">
                    <button
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <div class="inline-flex justify-center items-center">
{{--                            <img src="{{ asset('storage/'. auth()->user()->image) }}" width="35px" height="35px"--}}
{{--                                 class="rounded-full border" alt="user-image">--}}

                            <div class="ml-1">
                                <x-icon name="cog" class="w-8 h-8"/>
                            </div>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-bz.dropdown-link :href="route('admin.profile')">
                        {{ __('Profile') }}
                    </x-bz.dropdown-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-bz.dropdown-link :href="route('logout')"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-bz.dropdown-link>
                    </form>
                </x-slot>
            </x-bz.dropdown>
        </div>
    </div>
</nav>
