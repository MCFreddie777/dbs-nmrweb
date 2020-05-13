@extends('master')

@section('title','Analýzy')

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
            'items'=> $analyses,
            'empty'=> 'Ľutujeme, nenašli sa žiadne analýzy',
            'onclick'=> '/analyses'
        ],
        'header'=> [
            'items'=> [
                [
                    'name'=> 'id',
                ],
                [
                    'name'=> 'vzorka',
                    'key'=>'sample',
                ],
                [
                    'name'=> 'stav',
                    'key'=>'status',
                ],
                [
                    'name'=> 'laborant',
                    'key'=>'laborant',
                ],
                 [
                    'name'=> 'priemerný čas analytika pre analýzu',
                    'key'=>'avg_time',
                ],
            ],
        ],
        'layout'=> [
            [
                'width'=>24
            ],
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
                Analýzy
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
                class="{{ tableRowsClassObject($options,0) }} text-gray-500"
            >
                <p>{{ $item->id }}</p>
            </td>

            <td
                class="{{ tableRowsClassObject($options,1) }}"
            >
                @isset($item->sample)
                    <a href="{{url()->current()}}">{{ $item->sample }}</a>
                @endisset
            </td>

            <td
                class="{{ tableRowsClassObject($options,2)}}"
            >
                <x-ui.status-icon
                    class="absolute"
                    style="left:1em; top:40%;"
                    :status="$item->status_id"
                ></x-ui.status-icon>
                {{ $item->status }}
            </td>

            <td
                class="{{ tableRowsClassObject($options,3)}}"
            >
                {{ $item->laborant }}
            </td>

            <td
                class="{{ tableRowsClassObject($options,4)}}"
            >
                {{ \Carbon\CarbonInterval::seconds(round($item->avg_time))->cascade()->forHumans(['parts'=>3]) }}
            </td>

            @endscopedslot
        </x-ui.table>
    </div>


@stop
