@extends('layouts.admin.app')

@section('content')
    <div class="space-y-4">
        <h2 class="font-bold text-gray-700 text-3xl">Requester Verifications</h2>

        <div class="grid grid-cols-2 gap-4 pb-4">
            <div class="space-y-4">
                <div class="bg-white rounded-lg shadow-md p-4">
                    <div>
                        <h2 class="text-gray-700 font-bold text-xl">Update Status</h2>
                        <hr class="my-4">
                    </div>

                    <form method="POST" action="{{ route('admin.requester-verification.update-status', [$requesterVerification]) }}" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block font-medium text-gray-700">
                                Set Status
                            </label>

                            <div>
                                <input type="radio" value="0" name="status" id="not_verified"
                                   @checked(! $requesterVerification->status)
                                >
                                <label class="text-gray-700" for="not_verified">Not Verified</label>

                                <input class="ml-4" value="1" type="radio" name="status" id="verified"
                                    @checked($requesterVerification->status)
                                >
                                <label class="text-gray-700" for="verified"> Verified</label>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="bg-sky-500 text-white uppercase px-4 py-2 rounded">Save</button>
                            </div>

                        </div>

                        {{--                            <input--}}
                        {{--                                type="email"--}}
                        {{--                                id="UserEmail"--}}
                        {{--                                placeholder="john@rhcp.com"--}}
                        {{--                                class="mt-1 w-full rounded-md border-gray-200 shadow-sm"--}}
                        {{--                            />--}}
                    </form>
                </div>

                <div class="bg-white rounded-lg shadow-md p-4">
                    <div>
                        <h2 class="text-gray-700 font-bold text-xl">Requester Information</h2>
                        <hr class="my-4">
                    </div>

                    <div class="flow-root">
                        <dl class="-my-3 divide-y divide-gray-100 text-sm">
                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Full Name</dt>
                                <dd class="text-gray-700 sm:col-span-2 font-bold">{{ $requesterVerification->user->fullname() }}</dd>
                            </div>

                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Status</dt>
                                <dd class="sm:col-span-2">
                                    @if($requesterVerification->status)
                                        <span
                                            class="px-2 py-1 bg-green-500 uppercase text-xs font-bold text-white rounded">
                                        Verified
                                    </span>
                                    @else
                                        <span
                                            class="px-2 py-1 bg-red-500 uppercase text-xs font-bold text-white rounded">
                                        Not Verified
                                    </span>
                                    @endif

                                </dd>
                            </div>

                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Email</dt>
                                <dd class="text-gray-700 sm:col-span-2">{{ $requesterVerification->user->email }}</dd>
                            </div>

                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Phone Number</dt>
                                <dd class="text-gray-700 sm:col-span-2">{{ $requesterVerification->user->phone_number }}</dd>
                            </div>

                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Date of Birth</dt>
                                <dd class="text-gray-700 sm:col-span-2">{{ $requesterVerification->user->date_of_birth->format('F j, Y') }}</dd>
                            </div>

                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Current Address</dt>
                                <dd class="text-gray-700 sm:col-span-2">
                                    {{ $requesterVerification->user->address() }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-4">
                    <div>
                        <h2 class="text-gray-700 font-bold text-xl">Requester ID</h2>
                        <hr class="my-4">
                    </div>

                    <div class="flex justify-center items-center">
                        @if($requesterVerification->id_path)
                            <div class="space-y-2">
                                <label class="text-gray-700">
                                    ID TYPE
                                    <input class="w-full rounded shadow-md border-gray-400 text-gray-700" type="text"
                                           value="{{ $requesterVerification->id_type }}" readonly>
                                </label>

                                <img src="{{ asset('attachments/'. $requesterVerification->id_path) }}" width="450px"
                                     height="450px" alt="selfie with new born baby">
                            </div>
                        @else
                            <h2 class="text-3xl text-gray-700 uppercase">No uploaded file found</h2>
                        @endif
                    </div>
                </div>

            </div>

            <div class="space-y-4">

                <div class="bg-white rounded-lg shadow-md p-4">
                    <div>
                        <h2 class="text-gray-700 font-bold text-xl">Selfie with new born baby</h2>
                        <hr class="my-4">
                    </div>

                    <div class="flex justify-center items-center">
                        @if($requesterVerification->selfie_path)
                            <img src="{{ asset('attachments/'. $requesterVerification->selfie_path) }}" width="450px"
                                 height="450px" alt="selfie with new born baby">
                        @else
                            <h2 class="text-3xl text-gray-700 uppercase">No uploaded file found</h2>
                        @endif
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-4">
                    <div>
                        <h2 class="text-gray-700 font-bold text-xl">Birth Certificate</h2>
                        <hr class="my-4">
                    </div>

                    <div class="flex justify-center items-center">
                        @if($requesterVerification->birth_cert_path)
                            <img src="{{ asset('attachments/'. $requesterVerification->birth_cert_path) }}"
                                 width="450px"
                                 height="450px" alt="Birth certificate">
                        @else
                            <h2 class="text-3xl text-gray-700 uppercase">No uploaded file found</h2>
                        @endif
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-4">
                    <div>
                        <h2 class="text-gray-700 font-bold text-xl">Medical Record</h2>
                        <hr class="my-4">
                    </div>

                    <div class="flex justify-center items-center">
                        @if($requesterVerification->medical_record_path)
                            <div class="w-full">
                                <form method="POST"
                                      action="{{ route('admin.requester-verification.download', [$requesterVerification]) }}">
                                    @csrf

                                    <small class="text-gray-600">Click to download: </small> <br>
                                    <button
                                        class="w-full border border-gray-200 rounded-lg px-6 py-2 text-gray-700 hover:bg-gray-100 uppercase">
                                        Download Requester Medical Record
                                    </button>
                                </form>
                            </div>
                        @else
                            <h2 class="text-3xl text-gray-700 uppercase">No uploaded file found</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
