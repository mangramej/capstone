@extends('components.provider.layout')

@section('content')
    <div class="grid grid-cols-2 bg-gray-100 rounded-lg shadow-md h-[550px]">
        <div class="bg-white rounded-lg shadow-md text-gray-700 px-4">
            @if($transactions->isNotEmpty())
                <div class="flex flex-col h-full">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead class="ltr:text-left rtl:text-right">
                            <tr>
                                <th class="whitespace-nowrap px-4 py-2">
                                    <div class="flex flex-col text-start">
                                            <span class="w-full uppercase font-bold text-xl">
                                                Donated Milks
                                            </span>
                                        <span class="w-full text-xs text-gray-400">(Quantity)</span>
                                    </div>
                                </th>
                                <th class="whitespace-nowrap px-4 py-2">
                                    <div class="flex flex-col text-start">
                                            <span class="w-full uppercase font-bold text-xl">
                                                Date
                                            </span>
                                        <span class="w-full text-xs text-gray-400">(mm/dd/yyyy)</span>
                                    </div>
                                </th>
                            </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                            @foreach($transactions as $t)
                                <tr>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-900">
                                        <div class="flex space-x-2 items-center">
                                            <div class="bg-green-300 w-[10px] h-[10px] p-1 rounded-full"></div>
                                            <span class="font-bold text-lg">
                                            {{ $t->quantity }}
                                        </span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                    <span class="font-bold text-lg">
                                        {{ $t->created_at->format('m/d/Y') }}
                                    </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="w-full mt-auto">
                        {{ $transactions->links() }}
                    </div>
                </div>
            @else
                <div class="flex items-center justify-center h-full">
                    <div>
                        <h2 class="text-4xl font-bold text-cyan-500">No Result Found</h2>
                        <p class="text-gray-500 text-sm">Here will be shown about your donations. <br>You
                            have no donations.</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="p-4">
            @if(is_null(auth()->user()->donorApplication))
                <div class="flex flex-col h-full">
                    <div class="w-full">
                        <h1 class="text-3xl font-bold text-gray-900">
                            Milk Donor Prescreen
                        </h1>

                        <p class="text-xs text-gray-700 mt-4">
                            There is no greater gift to a family of a fragile baby than donor milk. Milk donations are
                            more
                            than just
                            nutrition, they are life-saving medicine!
                        </p>

                        <p class="text-xs text-gray-700 mt-4">
                            To become a milk donor, you must meet specific safety requirements before milk can
                            be accepted. This includes:
                        </p>

                        <ul class="list-disc ml-8 mt-2">
                            <li class="text-xs text-gray-700">
                                In good health and not using tobacco products, marijuana, or recreational drugs.
                            </li>
                            <li class="text-xs text-gray-700">
                                At low risk, along with their sexual partner(s), for communicable diseases (i.e.
                                HIV/AIDS,
                                Hepatitis B
                                or C, or Syphilis).
                            </li>
                            <li class="text-xs text-gray-700">
                                Collecting extra breastmilk beyond what your baby needs or milk that cannot be used by
                                your
                                baby.
                            </li>
                        </ul>
                    </div>

                    <div class="w-full mt-16 text-center">
                        <a href="{{ route('provider.donate-milk') }}"
                           class="bg-sky-500 text-white rounded-lg shadow-md px-6 py-4 font-bold uppercase hover:bg-sky-400 transition ease">
                            Start Donating
                        </a>
                    </div>

                    <div class="w-full mt-auto">
                        <div class="w-fit">
                            <h1 class="text-center text-2xl font-bold text-gray-900 sm:text-3xl">
                                {{ $milk_bags->total_milk_bags ?? 0 }}
                            </h1>

                            <p class="text-end mt-1.5 text-sm text-gray-500">
                                Total bags you provided
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="flex flex-col h-full">
                    <x-card>
                        @if(auth()->user()->donorApplication?->isApproved())
                            <div class="text-center">
                                <h2 class="text-2xl">You are now one of our Donor!</h2>
                                <p class="text-gray-600 mt-2">
                                    Your application ID:
                                    <span class="font-bold">
                                        {{ auth()->user()->donorApplication->application_id }}
                                    </span>
                                </p>
                                <p class="mt-1 text-xs text-gray-600">
                                    There is no greater gift to a family of a fragile baby than donor milk. Milk donations are more than just nutrition, they are life-saving medicine!
                                </p>
                            </div>
                        @elseif(auth()->user()->donorApplication?->isPending())
                            <div class="text-center">
                                <h2 class="text-2xl">Thank you for submitting you application</h2>
                                <p class="text-gray-600 mt-2">
                                    Your application ID:
                                    <span class="font-bold">{{ auth()->user()->donorApplication->application_id }}
                                </span>
                                </p>
                                <p class="text-gray-500 mt-2 text-xs">You can now go to these location to further verify
                                    you
                                    application <br>and start you first donation.</p>
                            </div>
                        @else
                            <div class="text-center">
                                <h2 class="text-2xl">Sadly, your application was declined</h2>
                                <p class="text-gray-600 mt-2">
                                    Your application ID:
                                    <span class="font-bold">{{ auth()->user()->donorApplication->application_id }}
                                </span>
                                </p>
                                <p class="text-gray-500 mt-2 text-xs">
                                    It appears that you did not meet the requirements to be eligible to give a healthy breast milk donation.
                                </p>
                            </div>
                        @endif
                    </x-card>

                    @if(! auth()->user()->donorApplication?->isDeclined())
                        <div class="w-full mt-4">
                            <div class="grid grid-cols-2 gap-4">
                                @foreach($locations as $loc)
                                    <div class="col-span-1">
                                        <x-card title="{{ $loc->name }}">
                                            <div class="flex space-x-2">
                                                <div class="p-1 rounded-full bg-sky-600 text-white">
                                                    <x-icon name="location-marker" class="w-5 h-5"/>
                                                </div>

                                                <span>
                                                {{ $loc->address }}
                                            </span>
                                            </div>
                                        </x-card>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="w-full mt-auto">
                        <div class="w-fit">
                            <h1 class="text-center text-2xl font-bold text-gray-900 sm:text-3xl">
                                {{ $milk_bags->total_milk_bags ?? 0 }}
                            </h1>

                            <p class="text-end mt-1.5 text-sm text-gray-500">
                                Total bags you provided
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
