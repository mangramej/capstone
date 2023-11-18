@props(['status'])

<div class="px-6 py-4 bg-white rounded-xl shadow h-fit">
    <div class="mb-2">
        <h2 class="font-bold text-gray-700">Status Activity</h2>
        <hr>
    </div>

    <ol class="border-l border-gray-300 dark:border-gray-500">
        <li>
            <div class="flex-start flex items-center pt-1">
                <div
                    class="-ml-[5px] mr-3 h-[9px] w-[9px] rounded-full bg-gray-300 dark:bg-gray-500"></div>
                <p class="text-sm text-gray-600 dark:text-gray-300">
                    {{ $status->pending_at->format('j.n.Y, g A') }}
                </p>
            </div>
            <div class="mb-6 ml-4 mt-2">
                <h4 class="mb-1.5 font-semibold text-gray-800">Pending</h4>
                <p class="mb-3 text-gray-600 text-xs">
                    The request is being pending.
                </p>
            </div>
        </li>

        @if($milkRequest->declines)
            <li>
                <div class="flex-start flex items-center pt-1">
                    <div
                        class="-ml-[5px] mr-3 h-[9px] w-[9px] rounded-full bg-gray-300 dark:bg-gray-500"></div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        {{ $milkRequest->declines->created_at->format('j.n.Y, g A') }}
                    </p>
                </div>
                <div class="mb-6 ml-4 mt-2">
                    <h4 class="mb-1.5 font-semibold text-gray-800">Declined</h4>
                    <p class="mb-3 text-gray-600 text-xs">
                        The request has been declined by champion.
                    </p>
                </div>
            </li>
        @endif

        @if($status->accepted_at)
            <li>
                <div class="flex-start flex items-center pt-1">
                    <div
                        class="-ml-[5px] mr-3 h-[9px] w-[9px] rounded-full bg-gray-300 dark:bg-gray-500"></div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        {{ $status->accepted_at->format('j.n.Y, g A') }}
                    </p>
                </div>
                <div class="mb-6 ml-4 mt-2">
                    <h4 class="mb-1.5 font-semibold text-gray-800">Accepted</h4>
                    <p class="mb-3 text-gray-600 text-xs">
                        The request has been acknowledged by champion.
                    </p>
                </div>
            </li>
        @endif

        @if($status->assigned_at)
            <li>
                <div class="flex-start flex items-center pt-1">
                    <div
                        class="-ml-[5px] mr-3 h-[9px] w-[9px] rounded-full bg-gray-300 dark:bg-gray-500"></div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        {{ $status->accepted_at->format('j.n.Y, g A') }}
                    </p>
                </div>
                <div class="mb-6 ml-4 mt-2">
                    <h4 class="mb-1.5 font-semibold text-gray-800">Provider Assigned</h4>
                    <p class="mb-3 text-gray-600 text-xs">
                        A provider has been assigned to the request.
                    </p>
                </div>
            </li>
        @endif

        @if($status->delivered_at)
            <li>
                <div class="flex-start flex items-center pt-1">
                    <div
                        class="-ml-[5px] mr-3 h-[9px] w-[9px] rounded-full bg-gray-300 dark:bg-gray-500"></div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        {{ $status->delivered_at->format('j.n.Y, g A') }}
                    </p>
                </div>
                <div class="mb-6 ml-4 mt-2">
                    <h4 class="mb-1.5 font-semibold text-gray-800">Delivered</h4>
                    <p class="mb-3 text-gray-600 text-xs">
                        The request has been delivered.
                    </p>
                </div>
            </li>
        @endif

        @if($status->confirmed_at)
            <li>
                <div class="flex-start flex items-center pt-1">
                    <div
                        class="-ml-[5px] mr-3 h-[9px] w-[9px] rounded-full bg-gray-300 dark:bg-gray-500"></div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        {{ $status->confirmed_at->format('j.n.Y, g A') }}
                    </p>
                </div>
                <div class="mb-6 ml-4 mt-2">
                    <h4 class="mb-1.5 font-semibold text-gray-800">Completed</h4>
                    <p class="mb-3 text-gray-600 text-xs">
                        The champion confirmed that you received your request.
                    </p>
                </div>
            </li>
        @endif
    </ol>
</div>
