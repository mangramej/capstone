@extends('layouts.champion')

@section('content')
    <main>
        <div class="flex flex-wrap sm:space-x-5 bg-white px-6 py-4 rounded-lg shadow-md">

            <div class="w-full mt-2 sm:mt-0 sm:w-3/4 text-gray-700">
                <h3 class="font-semibold text-lg sm:text-xl"> {{ $user->fullname() }} </h3>

                <p class="text-sm sm:text-normal">
                    {{ $user->email }}
                </p>

                <p class="text-sm sm:text-normal">
                    Total Request: {{ $requestCount }}
                </p>

                @if($user)
                    <form action="{{ route('threads.create', [$user]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <button type="submit"
                                class="mt-4 bg-sky-600 hover:bg-sky-500 px-4 py-2 rounded-lg text-white text-xs">
                            Message
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <section class="mt-4 bg-white rounded-lg shadow text-gray-700 px-4 pb-4">
            <div>
                @if($milkRequests->isNotEmpty())
                    <ul class="divide-y">
                        @foreach($milkRequests as $request)

                            <a href="{{ route('champion.milk-request-detail', [$request]) }}"
                               class="border-b"
                            >
                                <li class="grid grid-cols-4 py-2 w-full border-b border-b-gray-100 hover:bg-sky-100 transition ease">
                                    <div class="col-span-2">
                                        <div class="px-4">
                                            <span class="block text-xs sm:text-sm font-semibold">
                                                {{ $request->ref_number }}
                                            </span>

                                            <x-status-badge :status="$request->status"/>
                                        </div>
                                    </div>

                                    <div class="col-span-1">
                                    <span class="font-semibold block">
                                        {{ $request->quantity }} Milk bags
                                    </span>

                                        <span class="block text-xs sm:text-sm text-gray-500">
                                        Requesting milk bags
                                    </span>
                                    </div>

                                    <div class="col-span-1 px-4">
                                        <span class="block text-end text-sm font-bold">
                                            {{ $request->created_at->format('F j, Y g:i A') }}
                                        </span>
                                        <span class="block text-xs sm:text-sm text-gray-500 text-end">
                                            Requested At
                                        </span>
                                    </div>
                                </li>
                            </a>
                        @endforeach
                    </ul>

                @else
                    <div class="text-center items-center py-16">
                        <h2 class="text-4xl font-bold text-cyan-500">No Request Found</h2>
                        <p class="text-gray-500 text-sm">This requester hasn't sent you any request.</p>
                    </div>
                @endif
            </div>
        </section>

        <div class="mt-4">
            {{ $milkRequests->withQueryString()->links() }}
        </div>
    </main>
@endsection
