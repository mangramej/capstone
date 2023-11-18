<x-card title="Send a Milk Request">
    <form wire:submit.prevent="save">
        <small class="text-gray-500">Fill all required fields: *</small>
        <div class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="col-span-3 sm:col-span-2">
                    <x-input wire:model.defer="mother_name" label="Mother Name *" placeholder="the mother name" />
                </div>

                <div class="col-span-3 sm:col-span-1">
                    <x-inputs.number wire:model.defer="quantity" label="How many milk bags? *" min="1" />
                </div>

{{--                <div class="col-span-3 sm:col-span-2">--}}
{{--                    <span class="text-start text-sm w-full font-medium text-gray-700 dark:text-gray-400">--}}
{{--                        Upload ID *--}}
{{--                    </span>--}}

{{--                    <x-filepond wire:model="image" file-type="['image/*']" preview />--}}

{{--                    <span>--}}
{{--                        @if($errors->get('image'))--}}
{{--                            <ul class='text-sm text-red-600 space-y-1'>--}}
{{--                                @foreach ((array) $errors->get('image') as $message)--}}
{{--                                    <li>{{ $message }}</li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        @endif--}}
{{--                    </span>--}}
{{--                </div>--}}


                <div class="col-span-3 sm:col-span-1">
                    <x-input wire:model.defer="phone_number" label="Phone Number *" placeholder="your phone number" />
                </div>


                {{-- Address --}}
                <div class="flex flex-col justify-start items-center col-span-3 sm:col-span-2">
                    <span class="text-start w-full text-sm font-medium text-gray-700 dark:text-gray-400">Current Address *</span>

                    <input type="radio" class="hidden peer" id="current_address" checked>

                    <label for="current_address"
                           class="inline-flex justify-between items-center p-2 w-full bg-white rounded border-2 shadow hover:border-gray-800 cursor-pointer peer-checked:border-gray-800 peer-checked:bg-gray-100 hover:text-gray-600 hover:bg-gray-100"
                    >
                        <div class="flex flex-col items-center">
                            <small class="text-xs text-gray-800">
                                {{ auth()->user()->address() }}
                            </small>
                        </div>
                    </label>

                    <a href="{{ route('profile') }}"
                       class="text-cyan-600 hover:underline text-xs text-start w-full mt-1">Update current
                        address</a>
                </div>

                <div class="col-span-3">
                    <x-textarea wire:model.defer="comment" label="Additional Comment" placeholder="Your comment" />
                </div>

                <div class="col-span-3">
                   <div class="flex items-center space-x-2">
                       <x-toggle wire:model.defer="agreed"/>

                       <span class="text-sm text-gray-600">I agree to the <a href="#" class="text-sky-600">terms and agreements</a></span>
                   </div>
                    @error('agreements')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <x-slot name="footer">
            <div class="flex justify-between items-center">
                <x-button label="Close" flat negative x-on:click="$dispatch('close')"/>
                <x-button type="submit" label="Save" primary spinner wire:click="save"/>
            </div>
        </x-slot>
    </form>
</x-card>
