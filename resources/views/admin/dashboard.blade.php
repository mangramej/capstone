@extends('layouts.admin.app')

@section('content')
    <div>
        <div class="w-full">
            <section class="grid gap-6 my-6 md:grid-cols-3">
                <div class="p-6 bg-white shadow rounded-2xl">
                    <dl class="space-y-2">
                        <dt class="text-sm font-medium text-gray-500 flex justify-between items-center">
                            <span>Total Users</span>
                            <a href="{{ route('admin.users.index') }}"
                               class="text-sky-500 hover:underline hover:pointer">View All</a>
                        </dt>

                        <dd class="text-5xl font-light md:text-6xl">{{ $data['user.count'] }}</dd>

                        {{--                        <dd class="flex items-center space-x-1 text-sm font-medium {{ $data['user.growth'] > 0 ? 'text-green-500' : 'text-red-500' }}">--}}
                        {{--                            <span>--}}
                        {{--                                {{ Number::suffix($data['user.growth']) }}--}}
                        {{--                                {{ $data['user.growth'] > 0 ? 'increase' : 'decrease' }}--}}
                        {{--                            </span>--}}

                        {{--                            @if($data['user.growth'] > 0)--}}
                        {{--                                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">--}}
                        {{--                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.25 15.25V6.75H8.75"/>--}}
                        {{--                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 7L6.75 17.25"/>--}}
                        {{--                                </svg>--}}
                        {{--                            @else--}}
                        {{--                                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">--}}
                        {{--                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.25 8.75V17.25H8.75"/>--}}
                        {{--                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 17L6.75 6.75"/>--}}
                        {{--                                </svg>--}}
                        {{--                            @endif--}}
                        {{--                        </dd>--}}
                    </dl>
                </div>
            </section>
        </div>
    </div>

@endsection
