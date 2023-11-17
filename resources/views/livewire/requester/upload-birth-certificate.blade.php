<div class="w-2/3">
    <form wire:submit.prevent="upload">
        <div>
            <span class="text-start text-sm w-full font-medium text-gray-700">
                Upload a picture of birth certificate of the new born <span class="text-red-600">*</span>
            </span>
            @error('birth_certificate')
            <br>
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror

            <x-filepond wire:model="birth_certificate" file-size="5MB" file-type="['image/*']" preview/>
        </div>

        <x-button type="submit" primary label="Submit" spinner/>
    </form>
</div>
