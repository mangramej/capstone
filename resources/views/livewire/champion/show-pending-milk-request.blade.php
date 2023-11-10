<div wire:init="load">
    @if($readToLoad)
        @if($milkRequest)
        <div class="grid grid-cols-3 gap-2">
            <div class="col-span-3">
                <div class="grid grid-cols-3 gap-2">
                    <div class="col-span-2">
                        <div class="flex justify-between items-center">
                            <div >
                                <x-button.circle x-on:click="window.location.reload()" primary icon="refresh" spinner/>
                            </div>

                            <div>
                                <livewire:champion.update-request-status :milkRequest="$milkRequest"/>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start gap-2">
                        <x-button.circle
                            href="{{ route('champion.show-requester-request-history', ['user' => $milkRequest->requester_id]) }}"
                            type="submit"
                            icon="menu-alt-2"
                            warning
                        />

                        <div>
                            <form action="{{ route('threads.create', [$milkRequest->requester]) }}"
                                  method="POST">
                                @csrf
                                @method('PUT')

                                <x-button.circle
                                    type="submit"
                                    icon="chat"
                                    info
                                />
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-2">
                <x-card title="Milk Request Details">
                    <div class="flow-root">
                        <dl class="-my-3 divide-y divide-gray-100 text-sm">
                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Reference Number</dt>
                                <dd class="text-gray-700 sm:col-span-2 font-bold">{{ $milkRequest->ref_number }}</dd>
                            </div>

                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Mother Name</dt>
                                <dd class="text-gray-700 sm:col-span-2">{{ $milkRequest->mother_name }}</dd>
                            </div>

                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Baby Name</dt>
                                <dd class="text-gray-700 sm:col-span-2">{{ $milkRequest->baby_name }}</dd>
                            </div>

                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">No of Bags</dt>
                                <dd class="text-gray-700 sm:col-span-2">{{ $milkRequest->quantity }}</dd>
                            </div>

                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Phone Number</dt>
                                <dd class="text-gray-700 sm:col-span-2">{{ $milkRequest->phone_number }}</dd>
                            </div>

                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Address</dt>
                                <dd class="text-gray-700 sm:col-span-2">{{ $milkRequest->address }}</dd>
                            </div>

                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Uploaded Image ID</dt>
                                <dd class="text-gray-700 sm:col-span-2">
                                    <img src="{{ $milkRequest->getImageUrl() }}" alt="milk request ID image">
                                </dd>
                            </div>

                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Comment</dt>
                                <dd class="text-gray-700 sm:col-span-2">
                                    {{ $milkRequest->comment ?: 'No comment provided.' }}
                                </dd>
                            </div>
                        </dl>
                    </div>

                </x-card>
            </div>

            <div>
                <livewire:champion.request-status-activity :milkRequest="$milkRequest" />
            </div>
        </div>
        @else
            <div class="bg-white rounded-lg shadow h-[600px] flex justify-center items-center opacity-75">
                <div class="text-center space-y-4">
                    <span class="font-medium">No milk request available ...</span> <br>
                </div>
            </div>
        @endif
    @else
        <div class="bg-white rounded-lg shadow h-[600px] flex justify-center items-center opacity-75">
            <div class="text-center space-y-4">
                <span class="font-medium">Fetching Results</span> <br>
                <div
                    class="animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-blue-600 rounded-full"
                    role="status" aria-label="loading">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    @endif
</div>
