@props(['type','name','autofocus','placeholder','value','wFull','labeled'])

<div
    class="px-3 pb-1 bg-gray-300 rounded
    @isset($wFull) w-full @endisset
    @isset($labeled) pt-8 @endisset
        "
>
    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        class="bg-gray-300 pt-2 pb-1 text-gray-700 outline-none placeholder-gray-500 self-center align-middle w-full"
        @isset($autofocus) autofocus="{{ $autofocus }}" @endisset
        @isset($placeholder) placeholder="{{ $placeholder }}" @endisset
        @isset($value) value="{{ $value }}" @endisset
        required
    />
</div>
