@props(['size' => '16'])

<img src="{{ url('images/olfu-logo.png') }}" {{ $attributes->merge(['class' => 'block h-'. $size]) }} alt="baby-passport-logo"/>
