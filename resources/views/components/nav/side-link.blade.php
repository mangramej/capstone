@props(['link', 'icon', 'title', 'active' => false])

<li class="hover:bg-sky-100 transition ease cursor-pointer text-gray-700 {{ $active ? 'bg-sky-100' : ''  }}">
    <a href="{{ $link }}" class="w-full flex items-center space-x-2 px-6 py-2 ">
        {{ $icon }}

        <span>{{ $title }}</span>
    </a>
</li>
