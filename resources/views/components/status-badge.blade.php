@props(['status'])

@php
    use App\Modules\Enums\MilkRequestStatus;
@endphp

@switch($status)
    @case(MilkRequestStatus::Pending)
        <x-badge rounded warning label="Pending" />
        @break

    @case(MilkRequestStatus::Accepted)
        <x-badge rounded positive label="Accepted" />
        @break

    @case(MilkRequestStatus::Assigned)
        <x-badge rounded primary label="Provider Assigned" />
        @break

    @case(MilkRequestStatus::Delivered)
        <x-badge rounded violet label="Delivered" />
        @break

    @case(MilkRequestStatus::Confirmed)
        <x-badge rounded secondary label="Confirmed" />
        @break

    @case(MilkRequestStatus::Declined)
        <x-badge rounded negative label="Declined" />
        @break

    @default
        <x-badge rounded label="No Status" />
        @break
@endswitch
