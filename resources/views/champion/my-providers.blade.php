@extends('components.champion.layout')

@section('content')
    <section>
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2">
                <x-card title="Donor Applications">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead class="ltr:text-left rtl:text-right">
                            <tr>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                    Name
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                    Date
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                    Status
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                    Action
                                </td>
                            </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                            @forelse($applications as $applicant)
                                <tr>
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                        {{ $applicant->user->fullname() }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $applicant->created_at->format('m/d/Y') }}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ ucfirst($applicant->status) }}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                        <x-button href="{{ route('champion.my-providers.donor-application.show', [$applicant]) }}" xs sky label="View" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700" colspan="4">No Result found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $applications->links() }}
                        </div>
                    </div>


                </x-card>
            </div>
        </div>
    </section>
@endsection
