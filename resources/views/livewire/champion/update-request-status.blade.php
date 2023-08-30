<div>
    @if($milkRequest->status === \App\Modules\Enums\MilkRequestStatus::Pending)
        <livewire:champion.accept-decline-milk-request :milkRequest="$milkRequest"/>

    @elseif($milkRequest->status === \App\Modules\Enums\MilkRequestStatus::Accepted)
        <x-button
            icon="user"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'assign_provider_modal')"
            primary label="Assign Provider"
        />

        <x-breeze-modal name="assign_provider_modal" disableOverflow>
            <livewire:champion.assign-provider :milkRequest="$milkRequest"/>
        </x-breeze-modal>

    @elseif($milkRequest->status === \App\Modules\Enums\MilkRequestStatus::Assigned)
        <livewire:champion.set-to-deliver :milkRequest="$milkRequest"/>

    @elseif($milkRequest->status === \App\Modules\Enums\MilkRequestStatus::Delivered)
        <livewire:champion.set-to-confirmed :milkRequest="$milkRequest"/>
    @endif

    @if($milkRequest->accepted_by === auth()->id())
        <x-button
            icon="document-download"
            href="{{ route('champion.milk-request.download', $milkRequest) }}"
            dark label="Download"
        />
    @endif
</div>
