@extends('master')

@section('title','Laboratóriá')

@php
    $options=[
        'data' =>  [
            'items'=> $labs,
            'empty'=> 'Ľutujeme, nenašli sa žiadne laboratória',
            'onclick'=> '/administration/labs'
        ],
        'header'=> [
            'items'=> [
                [
                    'name'=> 'názov',
                    'key'=> 'name',
                ],
                [
                    'name'=> 'adresa',
                    'key'=> 'address',
                ],
            ],
        ],
        'layout'=> [
            [
                'left'=> true,
                'width'=>32
            ],
            [
                'left'=> true,
            ],
        ]
    ];
@endphp

@section('content')
    <div class="bg-white rounded-lg">
        <div class="p-4 pl-6 flex justify-between">
            <h1 class="text-2xl">
                Laboratóriá
            </h1>
            <div class="flex justify-end">
                <x-ui.search-bar
                    class="shadow-sm border mr-3"
                    :extendable="true"
                >
                </x-ui.search-bar>
                <x-ui.button
                    icon="fas fa-plus"
                    class="rounded-full"
                    text="Pridať laboratórium"
                    primary
                    type="link"
                    :href="url()->current().'/new'"
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
                class="{{ tableRowsClassObject($options,0) }}"
            >
                <p>{{ $item['name'] }}</p>
            </td>


            <td
                class="{{ tableRowsClassObject($options,1)}} text-gray-500"
            >
                {{  $item['address'] }}
            </td>

            @endscopedslot
        </x-ui.table>
    </div>


@stop
