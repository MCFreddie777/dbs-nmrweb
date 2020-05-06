@extends('master')

@section('title','Vzorky')

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
            'items'=> $samples,
            'empty'=> 'Ľutujeme, nenašli sa žiadne vzorky',
            'onclick'=> '/samples/'
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
                    'key'=> 'login',
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
        ],
        'pagination' => $pagination
    ];
@endphp

@section('content')
    <div class="bg-white rounded-lg">
        <div class="p-4 pl-6 flex justify-between">
            <h1 class="text-2xl">
                Vzorky
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
                <p>{{ $item->id }}</p>
            </td>


            <td
                class="{{ tableRowsClassObject($options,1)}}"
            >
                {{  (strlen($item->name) < 32 ) ? $item->name  : substr($item->name,0,29).'...'  }}
            </td>

            <td
                class="{{ tableRowsClassObject($options,2)}}"
            >
                {{  $item->user->login }}
            </td>

            <td
                class="{{ tableRowsClassObject($options,3)}}"
            >
                {{  $item->created_at }}
            </td>


            @endscopedslot
        </x-ui.table>
    </div>


@stop
