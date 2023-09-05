<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
<main>
    <nav x-data="{ open: false }" class="fixed z-50 w-full transition ease-in-out"
         id="navbar"
    >
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('home') }}">
                            <x-logo/>
                        </a>
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-bz.nav-link :href="route('login')" :active="request()->routeIs('login')">
                            {{ __('Login') }}
                        </x-bz.nav-link>
                    </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-bz.nav-link :href="route('register')" :active="request()->routeIs('register')">
                            {{ __('Register') }}
                        </x-bz.nav-link>
                    </div>
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-bz.responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    {{ __('Login') }}
                </x-bz.responsive-nav-link>

                <x-bz.responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                    {{ __('Register') }}
                </x-bz.responsive-nav-link>
            </div>
        </div>
    </nav>


    <div style="background-image: url('{{ url('/images/new-bg.png') }}')"
         class="bg-cover bg-center h-[300px] sm:h-[500px] md:h-[700px]">
    </div>

    <div class="bg-[#fffbe2]">
        <section class="relative grid grid-cols-1 md:grid-cols-3 gap-4 border-b shadow bg-white">
            <div class="flex items-center justify-center gap-2 py-8">
                <img src="{{  url('images/health.png') }}" class="w-24" alt="health.png">
                <p class="font-bold text-[#372008] leading-normal">
                    Food that is natural <br>
                    and made for you baby
                </p>
            </div>

            <div class="flex items-center justify-center gap-2 py-8">
                <img src="{{  url('images/iq.png') }}" class="w-24" alt="iq.png">
                <p class="font-bold text-[#372008] leading-normal">
                    Their brains are more healthy.
                </p>
            </div>

            <div class="flex items-center justify-center gap-2 py-8">
                <img src="{{  url('images/eyes.png') }}" class="w-24" alt="eyes.png">
                <p class="font-bold text-[#372008] leading-normal">
                    They can see more clearly.
                </p>
            </div>

            <div class="absolute inset-x-0 -bottom-10">
                <div class="flex justify-center">
                    <div class="absolute w-20 h-10 -top-1 p-6 bg-white"></div>
                    <div class="w-20 h-20 rounded-full border shadow p-6 bg-white"></div>
                </div>
            </div>
        </section>

        {{--                <section class="my-6 text-center py-24 flex">--}}
        {{--                    <div class="w-1/4 h-100 bg-no-repeat bg-left-top bg-[length:500px_100%]" style="background-image: url(' {{ url('/images/welcomeballs.png') }}')">--}}
        {{--                    </div>--}}

        {{--                    <div class="w-3/4 bg-transparent">--}}
        {{--                        <h1 class="text-2xl md:text-4xl font-bold text-[#372008]">Welcome to Baby Passport !</h1>--}}

        {{--                        <p class="text-lg text-center leading-relaxed text-[#372008]"> We warmly welcome all women who are looking for the best nutrition for their priceless infants.<br> At our website dedicated to breastfeeding, we recognize that occasionally,<br> unforeseen situations prevent moms from directly feeding their infants breast milk.<br> That's when our group of kind and giving mothers step in.</p>--}}

        {{--                        <p class="text-lg text-center leading-relaxed text-[#372008]">Here, we bring together moms who are able to provide their babies with an abundance of breast milk and those who,<br> for a variety of reasons, are unable to do so. For moms in need,<br> our platform acts as a loving sanctuary, cultivating a solid support system.</p>--}}
        {{--                    </div>--}}

        {{--                </section>--}}

        <div class="py-24">
            <div class="flex">
                <div class="w-1/4">
                    <img class="w-full h-full" src="{{ url('/images/welcomeballs.png') }}" alt="welcome.png">
                </div>

                <div class="w-3/4 space-y-5 text-center pr-24">
                    <h1 class="text-2xl md:text-4xl font-bold text-[#372008]">Welcome to Baby Passport !</h1>

                    <p class="text-lg text-center leading-relaxed text-[#372008] break-words"> We warmly welcome all
                        women who are looking for the best nutrition for their priceless infants. At our website
                        dedicated to
                        breastfeeding, we recognize that occasionally, unforeseen situations prevent moms from
                        directly feeding their infants breast milk. That's when our group of kind and giving mothers
                        step in.</p>

                    <p class="text-lg text-center leading-relaxed text-[#372008] break-words">Here, we bring together
                        moms who are
                        able to provide their babies with an abundance of breast milk and those who, for a variety
                        of reasons, are unable to do so. For moms in need, our platform acts as a loving sanctuary,
                        cultivating a solid support system.</p>
                </div>

                <div class="w-1/4">
                    <img class="w-full h-full" style="
                    position: relative;
                    -webkit-transform: scaleX(-1);
                    transform: scaleX(-1)" src="{{ url('/images/welcomeballs.png') }}" alt="welcome.png">
                </div>
            </div>


        </div>

    </div>


</main>

<script type="text/javascript">
    window.onscroll = () => {
        const nav = document.querySelector('#navbar')

        if (this.scrollY <= 80)
            nav.className = "fixed z-50 w-full transition ease-in-out";
        else
            nav.className = "fixed z-50 w-full transition shadow-xl ease-in-out bg-white";
    };
</script>
</body>
</html>
