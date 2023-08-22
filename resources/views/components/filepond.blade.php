{{--
    --- validation examples ---
    file type: ['image/*'] || ['image/png', 'image/jpeg']
    file size: 1 (byte), 1KB (kilobyte), 1MB (megabyte)
--}}

<div
    wire:ignore
    x-data
    x-init="
        FilePond.setOptions({
            acceptedFileTypes: {{ $attributes['file-type'] ?? '[]' }},
            maxFileSize: '{{ $attributes['file-size'] ?? '12MB' }}',
            allowImagePreview: {{ isset($attributes['preview']) ? 'true' : 'false' }},
            allowMultiple: {{ isset($attributes['multiple']) ? 'true' : 'false' }},

            server: {
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes['wire:model'] }}', file, load, error, progress)
                },

                revert: (filename, load, error) => {
                    @this.removeUpload('{{ $attributes['wire:model'] }}', filename, load)
                },
            }
        });
        FilePond.create($refs.input);
    "
>
    <input type="file" x-ref="input">
</div>
