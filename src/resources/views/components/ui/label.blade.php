@props(['key','center','for','class'])
<div
    class="flex pb-3 flex-row
    @isset($class) {{$class}} @endisset
    @isset($center) items-center @endisset"
>
    <label
        class="uppercase font-bold text-gray-500 text-sm block mr-2 w-1/5"
        @isset($for)
        for="{{ $for }}"
        @endisset
    >
        {{ $key }}:
    </label>
    {{ $slot }}
</div>
