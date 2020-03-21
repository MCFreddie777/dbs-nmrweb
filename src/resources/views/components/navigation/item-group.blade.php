@props(['group'])

<div class="mt-10">
    <p
        class="uppercase text-sm text-gray-500 font-bold mb-2 pl-6"
    >
        {{ $group['title'] }}
    </p>
    @foreach($group['items'] as $item)
        <x-navigation.item
            :item="$item"
        />
    @endforeach
</div>
