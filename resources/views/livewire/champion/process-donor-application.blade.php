<div class="space-y-4">
    @if($application->isPending())
        <div class="flex gap-4">
            <form
                action="{{ route('champion.my-providers.donor-application.approve', ['providerApplication' => $application]) }}"
                method="POST">
                @csrf

                <x-button
                    type="submit"
                    amber label="Approve Donor"
                />
            </form>

            <form
                action="{{ route('champion.my-providers.donor-application.decline', ['providerApplication' => $application]) }}"
                method="POST">
                @csrf
                @method('DELETE')

                <x-button
                    type="submit"
                    negative label="Decline Donor"
                />
            </form>
        </div>
    @endif

    @if($application->isDeclined())
        <div class="p-4 bg-red-500 rounded-lg shadow-md text-white">
            <span>This application has been declined</span>
        </div>
    @endif

    @if($application->isApproved())
        <div class="p-4 bg-green-500 rounded-lg shadow-md text-white">
            <span>This application has been approved</span>
        </div>
    @endif


    <x-card title="Donor Information">
        <div class="flow-root">
            <dl class="-my-3 divide-y divide-gray-100 text-sm">
                <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Application ID</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $application->application_id }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Name</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $application->user->fullname() }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Email</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $application->user->email }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Contact Number</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $application->user->phone_number }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Date of Birth</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $application->user->date_of_birth->format('F j, Y') }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Address</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $application->user->address() }}</dd>
                </div>
            </dl>
        </div>
    </x-card>

    <x-card title="Pre Screening">
        <div class="space-y-2">
            @foreach(unserialize($application->preScreening->content) as $item)
                <div>
                    <label>{{ $item['question'] }}</label>
                    <input type="text" value="{{ $item['answer'] }}"
                           class="rounded-lg shadow bg-gray-50 font-semibold text-sm" readonly>
                </div>
            @endforeach
        </div>
    </x-card>

    <x-card title="Attach Medical Records">
        <form wire:submit.prevent="uploadAttachment" class="space-y-4 mb-6">
            <x-input wire:model.defer="name" label="Name"/>

            <x-filepond wire:model="file" preview/>

            @error('file')
            <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror

            <div>
                <x-button type="submit" primary label="Submit" spinner/>
            </div>
        </form>

        @if($application->attachments->isNotEmpty())
            <small class="text-gray-600">Click to download: </small>
            <ul class="mt-1 border-2 divide-y rounded-lg">
                @foreach($application->attachments as $file)
                    <li class="px-6 py-4 cursor-pointer hover:bg-gray-100 hover:underline decoration-2 font-medium" wire:click="downloadAttachment({{ $file->id }})">{{ $file->name }}</li>
                @endforeach
            </ul>
        @endif
    </x-card>
</div>
