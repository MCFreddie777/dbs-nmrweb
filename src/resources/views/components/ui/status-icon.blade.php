@props(['status','class'])


<div
    class="h-2 w-2 rounded-full inline-block mr-1
    {{ $status == 2 ? 'bg-yellow-500' : '' }}
    {{ $status == 3 ? 'bg-white border border-gray-600' : '' }}
    {{ $status == 1 ? 'bg-green-500' : '' }}
    {{ $class ?? '' }}
        "
    {{ $attributes }}
></div>

