<article class="rounded-lg border border-gray-100 bg-white p-6 shadow" wire:init="load">
    @if($readyToLoad)
        <div>
            <p class="text-gray-500">Total Available Bags</p>

            <p class="text-2xl font-medium text-gray-900">{{ $count }}</p>
        </div>

    @else
        <div class="text-center space-y-4">
            <span class="text-gray-600 font-medium">Fetching Results</span> <br>
            <div
                class="animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-blue-600 rounded-full"
                role="status" aria-label="loading">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    @endif
</article>
