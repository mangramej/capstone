<div>
    <div class="hidden sm:flex sm:items-center sm:gap-2 ">
        <x-button icon="check" positive label="Accept" wire:click="accept" spinner/>
        <x-button icon="x" negative label="Decline" wire:click="decline" spinner/>
    </div>

    <div class="flex items-center gap-2 sm:hidden">
        <x-button.circle icon="check" positive wire:click="accept"/>
        <x-button.circle icon="x" negative wire:click="decline"/>
    </div>
</div>
