@props(['size' => '16'])

<img src="{{ url('images/logo.png') }}" {{ $attributes->merge(['class' => 'block h-'. $size]) }} alt="baby-passport-logo"/>
