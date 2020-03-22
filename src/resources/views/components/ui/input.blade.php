@props(['type','name','wFull','labeled','errorKey'])


<div
    class="px-3 pb-1 bg-gray-300 rounded
    @if( $errors->has($name) || (isset($errorKey) &&  $errors->has($errorKey))) border-2 border-red-500 @endif
    @isset($wFull) w-full @endisset
    @isset($labeled) pt-8 @endisset"
>
    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        class="bg-gray-300 pt-2 pb-1 text-gray-700 outline-none placeholder-gray-500 self-center align-middle w-full"
        {{ $attributes }}
    />
</div>
