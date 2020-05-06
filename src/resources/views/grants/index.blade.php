@extends('master')

@section('title','Granty')

@section('script')
    <script defer>
        setTimeout(function () {
            const form = document.querySelector('#searchForm');
            form.addEventListener('submit', event => {
                event.preventDefault();
                const input = document.querySelector('#searchForm input[type="search"]');
                if (!input.value.trim())
                    input.remove();
                form.submit();
            })
        }, 750);
    </script>
@endsection


@php
    $options=[
        'data' =>  [
            'items'=> $grants,
            'empty'=> 'Ľutujeme, nemáte žiadne granty',
            'onclick'=> '/grants'
        ],
        'header'=> [
            'items'=> [
                [
                    'name'=> 'názov',
                    'key'=> 'name',
                ],
                [
                    'name'=> 'počet vzoriek',
                    'key'=> 'samples',
                ],
            ],
        ],
        'layout'=> [
            [
                'left'=> true,
            ],
        ],
        'pagination' => $pagination,
    ];
@endphp

@section('content')
    <div class="bg-white rounded-lg">
        <div class="p-4 pl-6 flex justify-between">
            <h1 class="text-2xl">
                Moje granty
            </h1>
            <div class="flex justify-end">
                <form action="{{ Request::fullUrl() }}" id="searchForm" class="inline">
                    @if(Request::get('sort'))
                        <input type="hidden" name="sort" value="{{Request::get('sort')}}">
                    @endif
                    @if(Request::get('direction'))
                        <input type="hidden" name="direction" value="{{Request::get('direction')}}">
                    @endif
                    <x-ui.search-bar
                        class="shadow-sm border mr-3"
                        :extendable="true"
                        :value="Request::get('search')"
                    >
                    </x-ui.search-bar>
                </form>
            </div>
        </div>

        <x-ui.table
            :options="$options"
        >
            <!-- lib: konradkalemba/blade-components-scoped-slots -->
            @scopedslot('tableitem', ($item), ($options))
            <td
                class="{{ tableRowsClassObject($options,0) }}"
            >
                <p>{{ $item['name'] }}</p>
            </td>

            <td
                class="{{ tableRowsClassObject($options,1)}} text-gray-500"
            >
                {{  $item->samples }}
            </td>

            @endscopedslot
        </x-ui.table>
    </div>
@stop

