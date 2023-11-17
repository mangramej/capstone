<div class="w-2/3 space-y-2">
    <form wire:submit.prevent="upload">
        <span class="text-start text-sm w-full font-medium text-gray-700">
            Upload any file or medical records that proved that you are incapable of producing milk <span
                class="text-red-600">*</span>
        </span>
        @error('medical_record')
        <br>
        <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror

        <x-filepond wire:model="medical_record" preview/>

        <x-button type="submit" primary label="Submit" spinner/>
    </form>
</div>
