@extends('layouts.'.auth()->user()->type->value)

@if(auth()->user()->type === \App\Modules\Enums\UserEnum::Requester)
    @section('header')
        <div class="mt-8">
            <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">
                Your Messages
            </h1>

            <p class="mt-1.5 text-sm text-gray-500">
                Below are the history of your messages.
            </p>
        </div>
    @endsection
@endif

@section('content')
    <section>
        <div class="mx-auto max-w-screen-xl py-8 sm:px-6 lg:px-8">
            <main>
                <header class="text-gray-700">
                    <h2 class="text-2xl font-semibold">Messages</h2>
                </header>

                <section class="mt-4 bg-white rounded-xl shadow text-gray-700">
                    @foreach($threads as $t)
                        <div
                            class="hover:bg-sky-100 {{ $loop->first ? 'rounded-t-xl' : '' }} {{ $loop->last ? 'rounded-b-xl' : 'border-b' }}">
                            <a href="{{ route('threads.messages', [$t]) }}"
                               class="w-full h-full inline-flex items-center px-6 py-2 ">

                                {{--                        @if($t->participants[0]->user?->image)--}}
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($t->participants[0]->user->fullname()) }}&background=0D8ABC&color=fff" height="50px"
                                     width="50px" class="rounded-full bg-gray-100">

                                {{--                        @endif--}}

                                <div class="ml-4">
                                    <h3 class="font-semibold text-sm">
                                        {{ $t->participants[0]->user->fullname() }}
                                    </h3>
                                    @if($t->lastMessage)
                                        <p class="text-xs text-gray-400">{{ $t->lastMessage->user->fullname() }}
                                            : {{ str($t->lastMessage->content)->limit(35) }}
                                            - {{ $t->lastMessage->created_at->diffForHumans() }}</p>
                                    @endif
                                </div>
                            </a>
                        </div>
                    @endforeach
                </section>

                <div class="mt-4">
                    {{ $threads->links() }}
                </div>
            </main>
        </div>
    </section>
@endsection
