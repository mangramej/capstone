<div wire:init="load">
    @if($readToLoad)
        @if($milkRequest)
        <div class="grid grid-cols-4 gap-2">
            <div class="col-span-4">
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

            <div class="col-span-3 space-y-4">
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
                                <dt class="font-medium text-gray-900">No of Bags</dt>
                                <dd class="text-gray-700 sm:col-span-2">{{ $milkRequest->quantity }}</dd>
                            </div>

                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Phone Number</dt>
                                <dd class="text-gray-700 sm:col-span-2">{{ $milkRequest->phone_number }}</dd>
                            </div>

                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Email</dt>
                                <dd class="text-gray-700 sm:col-span-2">{{ $milkRequest->requester->email }}</dd>
                            </div>

                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Address</dt>
                                <dd class="text-gray-700 sm:col-span-2">{{ $milkRequest->address }}</dd>
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

                <x-card title="Attachments">
                    <div class="flow-root">
                        <dl class="-my-3 divide-y divide-gray-100 text-sm">
                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900 inline-flex items-center">Selfie with new born baby</dt>
                                <dd class="text-gray-700 sm:col-span-2">
                                    <x-button xs outline primary label="Click to View"
                                          x-data=""
                                          x-on:click.prevent="$dispatch('open-modal', 'view_selfie_modal')"
                                    />

                                    <x-breeze-modal name="view_selfie_modal">
                                        <div class="p-6">
                                            <img src="{{ asset('attachments/'. $milkRequest->requester->requesterVerification?->selfie_path) }}" width="100%" alt="selfie with new born baby">
                                        </div>
                                    </x-breeze-modal>
                                </dd>
                            </div>

                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900 inline-flex items-center">Baby Birth Certificate</dt>
                                <dd class="text-gray-700 sm:col-span-2">
                                    <x-button xs outline primary label="Click to View"
                                              x-data=""
                                              x-on:click.prevent="$dispatch('open-modal', 'view_birth_cert_modal')"
                                    />

                                    <x-breeze-modal name="view_birth_cert_modal">
                                        <div class="p-6">
                                            <img src="{{ asset('attachments/'. $milkRequest->requester->requesterVerification?->birth_cert_path) }}" width="100%" alt="baby birth certificate">
                                        </div>
                                    </x-breeze-modal>
                                </dd>
                            </div>

                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900 inline-flex items-center">Requester ID</dt>
                                <dd class="text-gray-700 sm:col-span-2">
                                    <x-button xs outline primary label="Click to View"
                                              x-data=""
                                              x-on:click.prevent="$dispatch('open-modal', 'view_id_modal')"
                                    />

                                    <x-breeze-modal name="view_id_modal">
                                        <div class="p-6">
                                            <label class="text-gray-700 mb-2">
                                                ID TYPE
                                                <input class="w-full rounded shadow-md border-gray-400 text-gray-700" type="text"
                                                       value="{{ $milkRequest->requester->requesterVerification?->id_type }}" readonly>
                                            </label>

                                            <img src="{{ asset('attachments/'. $milkRequest->requester->requesterVerification?->id_path) }}" width="100%" alt="requester ID">
                                        </div>
                                    </x-breeze-modal>
                                </dd>
                            </div>

                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900 inline-flex items-center">Medical Record</dt>
                                <dd class="text-gray-700 sm:col-span-2">
                                    <form method="POST"
                                          action="{{ route('champion.download-requester-medical-record', [$milkRequest->requester->requesterVerification]) }}">
                                        @csrf

                                        <x-button xs outline primary label="Click to Download" type="submit"/>
                                    </form>
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
                <div class="text-center">
                    <x-svg.two-document class="w-96 h-96 mb-4" />
                    <span class="text-3xl text-gray-400 font-medium uppercase">No milk request available</span>
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
