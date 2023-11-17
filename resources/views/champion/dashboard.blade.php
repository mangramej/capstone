@extends('components.champion.layout')

@section('content')
    <div class="grid grid-cols-3 rounded-lg shadow-md bg-white">
        <div class="bg-[#EEE3CB] rounded-lg shadow-md text-gray-700 p-4 h-full flex items-center ">
            <div class="divide-y-2 divide-gray-400">
                <div class="py-6 w-full grid grid-cols-2 gap-4 items-center">
                    <div class="flex justify-end">
                        <div
                            class="w-[125px] h-[125px] bg-yellow-200 rounded-full border-4 border-gray-800 flex items-center justify-center">
                            <span class="font-bold text-6xl">
                                {{ $total_milk_bags }}
                            </span>
                        </div>
                    </div>
                    <span class="font-bold uppercase">
                        Available Milk Bags
                    </span>
                </div>

                <div class="py-6 w-full grid grid-cols-2 gap-4 items-center">
                    <div class="flex justify-end">
                        <div
                            class="w-[125px] h-[125px] bg-blue-600 text-white rounded-full border-4 border-cyan-800 flex items-center justify-center">
                            <span class="font-bold text-6xl">
                                {{ $total_milk_requests }}
                            </span>
                        </div>
                    </div>
                    <span class="font-bold uppercase">
                        Milk Requests
                    </span>
                </div>

                <div class="py-6 w-full grid grid-cols-2 gap-4 items-center">
                    <div class="flex justify-end">
                        <div
                            class="w-[125px] h-[125px] bg-purple-600 text-white rounded-full border-4 border-purple-800 flex items-center justify-center">
                            <span class="font-bold text-6xl">
                                {{ $total_provider }}
                            </span>
                        </div>
                    </div>
                    <span class="font-bold uppercase">
                        Providers
                    </span>
                </div>
            </div>
        </div>

        <div class="col-span-2 p-4">
            <div class="flex flex-col h-full">
                <div class="w-full p-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex justify-center items-center">
                            <div
                                class="w-[250px] h-[250px] rounded-full border-4 shadow-sm bg-green-600 border-green-800 flex flex-col items-center justify-center">
                                <span class="font-bold text-8xl text-gray-800">
                                    {{ $total_confirmed_milk_request }}
                                </span>
                                <span class="font-bold uppercase text-gray-800 text-xs">
                                    Requests Completed
                                </span>
                            </div>
                        </div>

                        <div class="flex justify-center items-center">
                            <div
                                class="w-[250px] h-[250px] rounded-full border-4 shadow-sm bg-red-500 border-red-800 flex flex-col items-center justify-center">
                                <span class="font-bold text-8xl text-white">
                                    {{ $total_declined_milk_request }}
                                </span>
                                <span class="font-bold uppercase text-white text-xs">
                                    Requests Declined
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full mt-auto border-t-2 border-gray-400 py-6">
                    <div class="grid grid-cols-2">
                        <div class="flex justify-center items-center gap-4">
                            <div
                                class="w-[125px] h-[125px] rounded-full border-4 border-gray-800 flex items-center justify-center">
                                <span class="font-bold text-6xl text-gray-800">
                                    {{ $total_pending_milk_request }}
                                </span>
                            </div>

                            <span class="font-bold uppercase text-gray-800">
                                Pending Requests
                            </span>
                        </div>

                        <div class="flex justify-center items-center gap-4">
                            <div
                                class="w-[125px] h-[125px] rounded-full border-4 border-gray-800 flex items-center justify-center">
                                <span class="font-bold text-6xl text-gray-800">
                                    {{ $total_pending_donor_application }}
                                </span>
                            </div>

                            <span class="font-bold uppercase text-gray-800">
                                Pending Donor
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
