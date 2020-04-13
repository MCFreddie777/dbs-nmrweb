@extends('master')

@section('title','Spektrometre')

@php
    $options=[
        'data' =>  [
            'items'=> $spectrometers,
            'empty'=> 'Ľutujeme, nenašli sa žiadne spektrometre',
            'onclick'=> '/administration/spectrometers'
        ],
        'header'=> [
            'items'=> [
                [
                    'name'=> 'názov',
                    'key'=> 'name',
                ],
                [
                    'name'=> 'typ',
                    'key'=> 'type',
                ],
            ],
        ],
        'layout'=> [
            [
                'left'=> true,
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
                Spektrometre
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
                    text="Pridať spektrometer"
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
                class="{{ tableRowsClassObject($options,0)}}"
            >
                {{  $item['name'] }}
            </td>

            <td
                class="{{ tableRowsClassObject($options,1)}} text-gray-500"
            >
                {{  $item['type'] }}
            </td>

            @endscopedslot
        </x-ui.table>
    </div>


@stop
