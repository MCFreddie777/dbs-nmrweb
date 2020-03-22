@props(['text','icon','class','primary','secondary'])

<div
    class="flex justify-center items-center
    px-3 py-1 focus:outline-none hover:cursor-pointer
    {{ isset($primary) ? 'bg-yellow-500 text-white hover:bg-yellow-400' : '' }}
    {{ isset($secondary) ? 'border border-gray-600 text-gray-600 bg-gray-200' : '' }}
    {{ isset($class) ? $class : '' }}"
>
    @isset($icon)
        <i class="mr-2 {{ $icon }}"/></i>
    @endisset
    <button
        class="focus:outline-none"
        style="text-align: center;"
    >
        {{ $text }}
    </button>
</div>
