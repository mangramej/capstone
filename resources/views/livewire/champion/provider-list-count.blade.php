<div class="bg-[#EEE3CB] rounded-lg shadow-md text-gray-700 h-fit flex items-center justify-center">
    <div class="divide-y-2 divide-gray-400">
        <div class="py-6 w-full grid grid-cols-2 gap-4 items-center" >
            <div class="flex justify-end">
                <div
                    class="w-[125px] h-[125px] bg-yellow-200 rounded-full border-4 border-gray-800 flex items-center justify-center">
                    <span class="font-bold text-6xl">
                        {{ $stats['total_provider_count']}}
                    </span>
                </div>
            </div>
            <span class="font-bold uppercase">
                Provider
            </span>
        </div>

        <div class="py-6 w-full grid grid-cols-2 gap-4 items-center" >
            <div class="flex justify-end">
                <div
                    class="w-[125px] h-[125px] bg-green-200 rounded-full border-4 border-green-800 flex items-center justify-center">
                    <span class="font-bold text-6xl">
                        {{ $stats['total_active_provider_count'] }}
                    </span>
                </div>
            </div>
            <span class="font-bold uppercase">
                Active
            </span>
        </div>

        <div class="py-6 w-full grid grid-cols-2 gap-4 items-center">
            <div class="flex justify-end">
                <div
                    class="w-[125px] h-[125px] bg-red-600 text-white rounded-full border-4 border-red-800 flex items-center justify-center">
                    <span class="font-bold text-6xl">
                        {{ $stats['total_inactive_provider_count'] }}
                    </span>
                </div>
            </div>
            <span class="font-bold uppercase">
                Inactive
            </span>
        </div>
    </div>
</div>
