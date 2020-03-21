@php
    $segment = request()->segment(1);
    $active_route = "/$segment" == $item['path'];

@endphp

@props(['item'])

<div
    class="flex flex-col"
>
    <a
        href="{{ $item['path'] }}"
        class="
        flex items-center justify-center py-2 hover:bg-gray-700 hover:text-gray-500 w-1/6 w-full px-6
        {{ $active_route ? 'bg-gray-700 text-gray-500 border-r-4 border-yellow-500' : 'text-gray-600' }}"
    >
        <i
            class="{{ $item['icon'] }} w-1/6
            {{ $active_route ? "text-yellow-500" : '' }}"
        >
        </i>
        <span
            class="text-md w-5/6 pl-1"
        >
            {{ $item['title'] }}
        </span>
    </a>
</div>
