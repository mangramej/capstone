<div>
    @if($milkRequest->status === \App\Modules\Enums\MilkRequestStatus::Pending)
        <livewire:champion.accept-decline-milk-request :milkRequest="$milkRequest"/>

    @elseif($milkRequest->status === \App\Modules\Enums\MilkRequestStatus::Accepted)
        <x-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'assign_provider_modal')"
            primary label="Assign Provider"
        />

        <x-breeze-modal name="assign_provider_modal" disableOverflow>
            <livewire:champion.assign-provider :milkRequest="$milkRequest"/>
        </x-breeze-modal>
    @endif
</div>
