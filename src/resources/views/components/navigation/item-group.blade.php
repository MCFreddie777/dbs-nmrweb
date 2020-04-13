@props(['group'])

@if(!isset($group['gates']) || (isset($group['gates']) && Gate::any($group['gates'])))
    <div class="mt-10">
        <p
            class="uppercase text-sm text-gray-500 font-bold mb-2 pl-6"
        >
            {{ $group['title'] }}
        </p>
        @foreach($group['items'] as $item)
            @if(!isset($item['gates']) || (isset($item['gates']) && Gate::any($item['gates'])))
                <x-navigation.item
                    :item="$item"
                />
            @endif()
        @endforeach
    </div>
@endif
