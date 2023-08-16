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

                <div class="col-span-3 sm:col-span-2">
                    <x-input wire:model.defer="baby_name" label="Baby Name *" placeholder="the baby name"/>
                </div>

                <div class="col-span-3 sm:col-span-1">
                    <x-input wire:model.defer="phone_number" label="Phone Number *" placeholder="your phone number" />
                </div>

                {{-- Valid ID --}}
                <div class="col-span-3 sm:col-span-2">
                    <span class="text-start text-sm w-full font-medium text-gray-700 dark:text-gray-400">Upload ID *</span>

                    <div class="mb-4 bg-gray-100 border-2 border-gray-300 border-dashed rounded-md appearance-none hover:border-gray-400 focus:outline-none hidden"
                         id="preview-image-container"
                    >
                        <img
                            src="https://placehold.co/450x300"
                            id="preview-image"
                            class="mx-auto w-[450px] h-[300px] my-4 object-contain hidden"
                            x-cloak
                            alt="preview-image"
                        >
                    </div>

                    <label
                        class="flex justify-center w-full h-16 px-4 transition bg-white border-2 border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-gray-400 focus:outline-none">
                            <span class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <span class="font-medium text-gray-600">
                                    Click here to
                                    <span class="text-cyan-600 underline">browse</span>
                                </span>
                            </span>
                        <input type="file" name="image" class="hidden" id="select-image">
                    </label>

                    {{--                <x-input-error :messages="$errors->get('image')" class="mt-2"/>--}}
                </div>

                {{-- Address --}}
                <div class="flex flex-col justify-start items-center col-span-3 sm:col-span-1">
                    <span class="text-start w-full text-sm font-medium text-gray-700 dark:text-gray-400">Current Address *</span>

                    <input type="radio" class="hidden peer" id="current_address" checked>

                    <label for="current_address"
                           class="inline-flex justify-between items-center p-2 w-full bg-white rounded border-2 shadow hover:border-gray-800 cursor-pointer peer-checked:border-gray-800 peer-checked:bg-gray-100 hover:text-gray-600 hover:bg-gray-100"
                    >
                        <div class="flex flex-col items-center">
                            <small class="text-xs text-gray-800">
                                {{ auth()->user()->getAddressAttribute() . ', ' . auth()->user()->zip_code }}
                            </small>
                        </div>
                    </label>

                    <a href="#"
                       class="text-cyan-600 hover:underline text-xs text-start w-full mt-1">Update current
                        address</a>
                </div>

                <div class="col-span-3">
                    <x-textarea wire:model.defer="comment" label="Comment *" placeholder="Your comment" />
                </div>

                <div class="col-span-3">
                    <x-toggle wire:model.defer="agreed" label="Accept the terms and conditions"/>
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

@push('scripts')
    <script>
        const previewImage = document.getElementById('preview-image')
        const selectImage = document.getElementById('select-image')
        const previewImageContainer = document.getElementById('preview-image-container')

        selectImage.onchange = () => {
            previewImage.style.display = 'block';
            const [file] = selectImage.files

            if (file) {
                previewImage.src = URL.createObjectURL(file)
                previewImage.classList.remove('hidden')
                previewImageContainer.classList.remove('hidden')
            } else {
                previewImage.classList.add('hidden')
                previewImageContainer.classList.add('hidden')
                previewImage.src = ''
                previewImage.style.display = null
            }
        }
    </script>
@endpush
