<div>
    <div class="space-y-4 pb-8">
        <details class="group [&_summary::-webkit-details-marker]:hidden" open>
            <summary
                class="flex cursor-pointer items-center justify-between gap-1.5 rounded-lg bg-gray-50 p-4 text-gray-900"
            >
                <div class="flex gap-2 items-center">
                    @if(! auth()->user()->requesterVerification?->selfie_path)
                        <span class="text-sky-600">
                            <x-icon name="exclamation-circle" class="w-5 h-5" solid/>
                        </span>
                    @else
                        <span class="text-green-600">
                            <x-icon name="check-circle" class="w-5 h-5" solid/>
                        </span>
                    @endif
                    <h2 class="font-medium">
                        Upload a Selfie
                    </h2>
                </div>

                <svg
                    class="h-5 w-5 shrink-0 transition duration-300 group-open:-rotate-180"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 9l-7 7-7-7"
                    />
                </svg>
            </summary>

            @if(! auth()->user()->requesterVerification?->selfie_path)
                <div class="mt-4 px-4">
                    <livewire:requester.upload-selfie/>
                </div>
            @endif
        </details>

        @if(auth()->user()->requesterVerification?->selfie_path)
            <details class="group [&_summary::-webkit-details-marker]:hidden">
                <summary
                    class="flex cursor-pointer items-center justify-between gap-1.5 rounded-lg bg-gray-50 p-4 text-gray-900"
                >
                    <div class="flex gap-2 items-center">
                        @if(! auth()->user()->requesterVerification?->birth_cert_path)
                            <span class="text-sky-600">
                            <x-icon name="exclamation-circle" class="w-5 h-5" solid/>
                        </span>
                        @else
                            <span class="text-green-600">
                            <x-icon name="check-circle" class="w-5 h-5" solid/>
                        </span>
                        @endif
                        <h2 class="font-medium">
                            Upload a picture of birth certificate
                        </h2>
                    </div>

                    <svg
                        class="h-5 w-5 shrink-0 transition duration-300 group-open:-rotate-180"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 9l-7 7-7-7"
                        />
                    </svg>
                </summary>

                @if(! auth()->user()->requesterVerification?->birth_cert_path)
                    <div class="mt-4 px-4">
                        <livewire:requester.upload-birth-certificate/>
                    </div>
                @endif
            </details>
        @endif

        @if(auth()->user()->requesterVerification?->birth_cert_path)
            <details class="group [&_summary::-webkit-details-marker]:hidden">
                <summary
                    class="flex cursor-pointer items-center justify-between gap-1.5 rounded-lg bg-gray-50 p-4 text-gray-900"
                >
                    <div class="flex gap-2 items-center">
                        @if(! auth()->user()->requesterVerification?->id_path)
                            <span class="text-sky-600">
                            <x-icon name="exclamation-circle" class="w-5 h-5" solid/>
                        </span>
                        @else
                            <span class="text-green-600">
                            <x-icon name="check-circle" class="w-5 h-5" solid/>
                        </span>
                        @endif
                        <h2 class="font-medium">
                            Upload a valid ID
                        </h2>
                    </div>

                    <svg
                        class="h-5 w-5 shrink-0 transition duration-300 group-open:-rotate-180"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 9l-7 7-7-7"
                        />
                    </svg>
                </summary>

                @if(! auth()->user()->requesterVerification?->id_path)
                    <div class="mt-4 px-4">
                        <livewire:requester.upload-valid-id/>
                    </div>
                @endif
            </details>
        @endif

        @if(auth()->user()->requesterVerification?->id_path)
            <details class="group [&_summary::-webkit-details-marker]:hidden">
                <summary
                    class="flex cursor-pointer items-center justify-between gap-1.5 rounded-lg bg-gray-50 p-4 text-gray-900"
                >
                    <div class="flex gap-2 items-center">
                        @if(! auth()->user()->requesterVerification?->medical_record_path)
                            <span class="text-sky-600">
                            <x-icon name="exclamation-circle" class="w-5 h-5" solid/>
                        </span>
                        @else
                            <span class="text-green-600">
                            <x-icon name="check-circle" class="w-5 h-5" solid/>
                        </span>
                        @endif
                        <h2 class="font-medium">
                            Upload a medical proof
                        </h2>
                    </div>

                    <svg
                        class="h-5 w-5 shrink-0 transition duration-300 group-open:-rotate-180"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 9l-7 7-7-7"
                        />
                    </svg>
                </summary>

                @if(! auth()->user()->requesterVerification?->medical_record_path)
                    <div class="mt-4 px-4">
                        <livewire:requester.upload-medical-record/>
                    </div>
                @endif
            </details>
        @endif

        @if(auth()->user()->requesterVerification?->medical_record_path)
            <details class="group [&_summary::-webkit-details-marker]:hidden" open>
                <summary
                    class="flex cursor-pointer items-center justify-between gap-1.5 rounded-lg bg-gray-50 p-4 text-gray-900"
                >
                    <div class="flex gap-2 items-center">
                        <span class="text-sky-600">
                            <x-icon name="exclamation-circle" class="w-5 h-5" solid/>
                        </span>
                        <h2 class="font-medium">
                            Thank You!
                        </h2>
                    </div>

                    <svg
                        class="h-5 w-5 shrink-0 transition duration-300 group-open:-rotate-180"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 9l-7 7-7-7"
                        />
                    </svg>
                </summary>

                <p class="mt-4 px-4 leading-relaxed text-gray-700">
                    It might take a couple of days to process your verification, but once you get verified you can now
                    start requesting a milk.
                </p>
            </details>
        @endif
    </div>
</div>
