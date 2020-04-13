@extends('master')

@section('title','Rozpúšťadlá')

@php
    $options=[
        'data' =>  [
            'items'=> $solvents,
            'empty'=> 'Ľutujeme, nenašli sa žiadne rozpúšťadlá',
            'onclick'=> '/administration/solvents'
        ],
        'header'=> [
            'items'=> [
                [
                    'name'=> 'id',
                ],
                [
                    'name'=> 'názov',
                    'key'=> 'name',
                ],
            ],
        ],
        'layout'=> [
            [
                'left'=> true,
                'width'=>16
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
                Rozpúšťadlá
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
                    text="Pridať rozpúšťadlo"
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
                class="text-gray-500 {{ tableRowsClassObject($options,0) }}"
            >
                <p>{{ $item['id'] }}</p>
            </td>


            <td
                class="{{ tableRowsClassObject($options,1)}}"
            >
                {{  $item['name'] }}
            </td>

            @endscopedslot
        </x-ui.table>
    </div>


@stop
