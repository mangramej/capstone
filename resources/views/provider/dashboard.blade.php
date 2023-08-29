@extends('layouts.provider')

@section('header')
    <div class="mt-8 flex justify-between items-center">
        <div class="w-full sm:w-fit">
            <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">
                Hi, {{ auth()->user()->first_name }}
            </h1>

            <p class="mt-1.5 text-sm text-gray-500">
                Below are the list of your bags you provided.
            </p>
        </div>

        <div class="w-full sm:w-fit">
            <h1 class="text-end text-2xl font-bold text-gray-900 sm:text-3xl">
                {{ $milk_bags->sum('transactions_sum_quantity') }}
            </h1>

            <p class="text-end mt-1.5 text-sm text-gray-500">
                Total bags you provided
            </p>
        </div>
    </div>
@endsection

@section('content')
    <section>
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 lg:px-8">

            <section class="mt-4 bg-white rounded-lg shadow text-gray-700 px-4">
                @if($milk_bags->isNotEmpty())
                    <ul class="divide-y">
                        @foreach($milk_bags as $t)

                            <li class="grid grid-cols-4 py-2 w-full border-b border-b-gray-100">
                                <div class="col-span-2">
                                    <div class="px-4">
                                        <span class="font-semibold block">
                                            {{ $t->champion->fullname() }}
                                        </span>

                                        <span class="block text-xs sm:text-sm text-gray-500">
                                            Champion Name
                                        </span>
                                    </div>
                                </div>

                                <div class="col-span-1">
                                    <span class="font-semibold block">
                                        {{ $t->transactions_sum_quantity }} Milk bags
                                    </span>

                                            <span class="block text-xs sm:text-sm text-gray-500">
                                        Amount you provided
                                    </span>
                                </div>

                                <div class="col-span-1 px-4">
                                    <span class="block text-end">
                                        {{ $t->created_at->format('F j, Y') }}
                                    </span>
                                            <span class="block text-xs sm:text-sm text-gray-500 text-end">
                                        Date
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                @else
                    <div class="text-center items-center py-16">
                        <h2 class="text-4xl font-bold text-cyan-500">No Result Found</h2>
                        <p class="text-gray-500 text-sm">Here will be shown about your donations,<br> You
                            have no donations.</p>
                    </div>
                @endif
            </section>
        </div>
    </section>
@endsection
