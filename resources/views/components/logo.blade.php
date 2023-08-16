@props(['size' => '16'])

<img src="{{ url('images/baby-passport-logo.png') }}" {{ $attributes->merge(['class' => 'block h-'. $size]) }} alt="baby-passport-logo"/>
