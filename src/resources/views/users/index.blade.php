@extends('master')

@section('title','Správa užívateľov')

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
            'items'=> $users,
            'empty'=> 'Ľutujeme, nenašli sa žiadni užívatelia',
            'onclick'=> '/users/'
        ],
        'header'=> [
            'items'=> [
                [
                    'name'=> 'login',
                ],
                [
                    'name'=> 'rola',
                    'key'=> 'role',
                ],
                [
                    'name'=> 'počet vzoriek',
                    'key'=> 'samples',
                ],
            ],
        ],
        'layout'=> [
            [
                'left'=> true
            ]
        ],
        'pagination' => $pagination
    ];
@endphp

@section('content')
    <div class="bg-white rounded-lg">
        <div class="p-4 pl-6 flex justify-between">
            <h1 class="text-2xl">Užívatelia</h1>
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
                <x-ui.button
                    icon="fas fa-plus"
                    class="rounded-full"
                    text="Nový užívateľ"
                    primary
                >
                </x-ui.button>
            </div>
        </div>

        <x-ui.table
            :options="$options"
        >
            <!-- lib: konradkalemba/blade-components-scoped-slots -->
            @scopedslot('tableitem', ($item), ($options))
            <td
                class="{{ tableRowsClassObject($options,0)}}"
            >
                <div class="flex items-center">

                    <div
                        class="rounded-full text-white bg-yellow-500 w-10 h-10 flex justify-center items-center">
                        {{ ucfirst($item->login[0]) }}
                    </div>
                    <span class="ml-3">{{ $item->login }}</span>
                </div>
            </td>

            <td
                class="text-gray-600
                    {{ tableRowsClassObject($options,1)}}"
            >
                {{ $item->role }}
            </td>

            <td
                class="text-gray-600
                    {{ tableRowsClassObject($options,1)}}"
            >
                {{ $item->samples }}
            </td>
            @endscopedslot
        </x-ui.table>
    </div>
@stop
