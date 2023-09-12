<div>
    <x-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'set_to_confirm_modal')"
        dark label="Set to Confirm"
        spinner
    />

    <x-breeze-modal name="set_to_confirm_modal">
        <x-card>
            <div class="px-4">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Are you sure you that the requester received the package?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Try contacting the requester before confirming, Below are the information of the requester:') }}
                </p>

                <table class="w-full mt-4">
                    <tbody>
                    <tr>
                        <td>Reference Number</td>
                        <td colspan="2"
                            class="text-right font-bold">{{ $milkRequest->ref_number }}</td>
                    </tr>
                    <tr>
                        <td>Mother Name</td>
                        <td colspan="2"
                            class="text-right font-bold">{{ $milkRequest->mother_name }}</td>
                    </tr>
                    <tr>
                        <td>No of Bags</td>
                        <td colspan="2"
                            class="text-right font-bold">{{ $milkRequest->quantity }}</td>
                    </tr>
                    <tr>
                        <td>Contact Number</td>
                        <td colspan="2"
                            class="text-right font-bold">{{ $milkRequest->phone_number }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <x-slot name="footer">
                <div class="flex justify-between items-center">
                    <x-button label="Close" flat negative x-on:click="$dispatch('close')"/>
                    <x-button label="Save" primary spinner wire:click="confirm" x-on:click="$dispatch('close')"/>
                </div>
            </x-slot>
        </x-card>
    </x-breeze-modal>

</div>
