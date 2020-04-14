@extends('master')

@section('title','Správa užívateľov')

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
                    'key'=> 'role.name',
                ],
                [
                    'name'=> 'počet vzoriek',
                ],
            ],
        ],
        'layout'=> [
            [
                'left'=> true
            ]
        ]
    ];
@endphp

@section('content')

    <div class="bg-white rounded-lg">
        <div class="p-4 pl-6 flex justify-between">
            <h1 class="text-2xl">Užívatelia</h1>
            <div class="flex justify-end">
                <x-ui.search-bar
                    class="shadow-sm border mr-3"
                    :extendable="true"
                >
                </x-ui.search-bar>
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
                {{ $item->role_name }}
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
