@props(['options'])

<table
    class="w-full shadow-sm"
    style="text-align: center;"
>
    <!-- Header -->
    <thead
        class="block overflow-y-auto w-full"
    >
    <tr
        class="table w-full"
        style="table-layout: fixed;"
    >
        @foreach($options['header']['items'] as $index => $item)
            <th
                class="py-1 pb-4 font-normal uppercase text-xs text-gray-500 hover:cursor-pointer relative
                {{ tableRowsClassObject($options, $index,false) }}">
                {{  $item['name'] }}
            </th>
        @endforeach
    </tr>
    </thead>

    <tbody
        class="block overflow-y-auto w-full border-t border-gray-200"
        style="max-height: calc(100vh - (32px * 2) - 72px - 65px - 38px);"
    >

    <!-- Table rows , scoped slots -->
    @forelse($options['data']['items'] as $item)
        <tr
            class="hover:cursor-pointer hover:bg-gray-100 table w-full"
            style="table-layout: fixed;"
        >
            {{ $tableitem($item) }}
        </tr>
    @empty
        <!-- Empty message -->
        <tr
            class="table w-full"
            style="table-layout: fixed;"
        >
            <td
                class="py-3 border-b border-gray-200"
                colspan="{{ count($options['header']['items']) }}"
            >
                <p class="text-gray-600 px-6 text-left">
                    {{ $options['data']['empty'] }}
                </p>
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
