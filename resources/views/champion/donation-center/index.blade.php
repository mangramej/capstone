@extends('components.champion.layout')

@section('content')
    <section>
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2 space-y-4">
                <div>
                    <x-button href="{{ route('champion.location.create') }}" label="Add Donation Center" primary />
                </div>

                <x-card title="Donation Center">
                    <!--
                      Heads up! 👋

                      This component comes with some `rtl` classes. Please remove them if they are not needed in your project.
                    -->

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead class="ltr:text-left rtl:text-right">
                            <tr>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                    Name
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                    Address
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                    Action
                                </td>
                            </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                            @forelse($locations as $loc)
                                <tr>
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                        {{ $loc->name }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $loc->address }}</td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                        <div class="flex space-x-2">
                                            <x-button href="{{ route('champion.location.edit', [$loc]) }}" sky xs label="Edit" />
                                            <form method="POST" action="{{ route('champion.location.destroy', [$loc]) }}">
                                                @csrf
                                                @method('DELETE')

                                                <x-button type="submit" negative xs label="Delete" />
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <p class="px-2 py-1.5 text-center">No donation center found <br> Add a donation center so that donor know where to donate</p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $locations->links() }}
                        </div>
                    </div>
                </x-card>
            </div>
        </div>
    </section>
@endsection
