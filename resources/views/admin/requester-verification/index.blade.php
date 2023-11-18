@extends('layouts.admin.app')

@section('content')
    <div class="space-y-4">
        <h2 class="font-bold text-gray-700 text-3xl">Requester Verifications</h2>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                    <thead>
                    <tr>
                        <td class="whitespace-nowrap px-4 py-2 font-bold uppercase text-gray-900">
                            Name
                        </td>
                        <td class="whitespace-nowrap px-4 py-2 font-bold uppercase text-gray-900">
                            Email
                        </td>
                        <td class="whitespace-nowrap px-4 py-2 font-bold uppercase text-gray-900">
                            Status
                        </td>
                        <td class="whitespace-nowrap px-4 py-2 font-bold uppercase text-gray-900">
                            Actions
                        </td>
                    </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                    @forelse($applications as $app)
                        <tr>
                            <td class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">
                                {{ $app->user->fullname() }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                {{ $app->user->email }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2">
                                @if($app->user->requesterVerification->status)
                                    <span class="px-2 py-1 bg-green-500 uppercase text-xs font-bold text-white rounded">
                                        Verified
                                    </span>
                                @else
                                    <span class="px-2 py-1 bg-red-500 uppercase text-xs font-bold text-white rounded">
                                        Not Verified
                                    </span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                <a href="{{ route('admin.requester-verification.show', [$app]) }}" class="text-sky-600 hover:underline">View Details</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="whitespace-nowrap px-4 py-2 text-gray-700">No result found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $applications->links() }}
            </div>
        </div>
    </div>
@endsection
