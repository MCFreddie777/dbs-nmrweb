@extends('master')

@section('title','Vzorky')

@php
    $options=[
        'data' =>  [
            'items'=> $samples,
            'empty'=> 'Ľutujeme, nenašli sa žiadne vzorky',
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
                [
                    'name'=> 'používateľ',
                    'key'=> 'user.login',
                ],
                [

                    'name'=> 'dátum',
                    'key'=> 'created_at',
                ],
            ],
        ],
        'layout'=> [
            [
                'width'=> 16,
            ],
            [
                'width'=> 96,
                'width-sm'=> 64,
                'left'=> true
            ]
        ]
    ];
@endphp

@section('content')
    <div class="bg-white rounded-lg">
        <div class="p-4 pl-6 flex justify-between">
            <h1 class="text-2xl">
                Vzorky
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
                    text="Pridať vzorku"
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
                class="text-gray-600 {{ tableRowsClassObject($options,0) }}"
            >
                <p>{{ $item['id'] }}</p>
            </td>


            <td
                class="{{ tableRowsClassObject($options,1)}}"
            >
                {{--                @dump($options['layout'][2])--}}
                {{  $item['name'] }}
            </td>

            <td
                class="{{ tableRowsClassObject($options,2)}}"
            >
                {{  $item['user']['login'] }}
            </td>

            <td
                class="{{ tableRowsClassObject($options,3)}}"
            >
                {{  $item['created_at'] }}
            </td>


            @endscopedslot
        </x-ui.table>
    </div>


@stop
