<div class="w-2/3 space-y-2">
    <form wire:submit.prevent="upload">
        <div>
            <span class="text-start text-sm w-full font-medium text-gray-700">
                ID Type <span class="text-red-600">*</span>
            </span>
            <x-native-select wire:model.defer="type">
                <option value="">-- ID type --</option>
                <option value="Philippine passport">Philippine passport</option>
                <option value="Driver’s license">Driver’s license</option>
                <option value="National ID">National ID</option>
                <option value="SSS UMID Card">SSS UMID Card</option>
                <option value="PhilHealth ID">PhilHealth ID</option>
                <option value="TIN Card">TIN Card</option>
                <option value="Voter’s ID">Voter’s ID</option>
                <option value="OFW ID">OFW ID</option>
                <option value="Other">Other</option>
            </x-native-select>
        </div>
        <div>
        <span class="text-start text-sm w-full font-medium text-gray-700">
            Upload a picture of valid ID<span class="text-red-600">*</span>
        </span>
            <x-filepond wire:model="image" file-type="['image/*']" preview/>
            @error('image')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <x-button type="submit" primary label="Submit" spinner/>
    </form>

</div>
