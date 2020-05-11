@extends('master')

@section('title','Analýza vzorky'.$analysis->sample->name)

@section('content')
    <div class="bg-white rounded-lg">
        <div class="p-4 pl-6">

            <h1
                class="text-2xl mb-10"
            >
                <span class="text-gray-600">Analýza vzorky  </span>
                <a
                    class="text-blue-600 hover:underline ml-1"
                    href="{{ url('/samples',$analysis->sample->id) }}"
                >
                    {{ ucfirst($analysis->sample->name) }}
                </a>
            </h1>

            <x-ui.label
                key="status"
                center
            >
                <div class="relative flex items-center">
                    <x-ui.status-icon
                        :status="$analysis->status()->id"
                        style="position:absolute; left:-1em;"
                    ></x-ui.status-icon>
                    {{$analysis->status()->name}}
                    @can('user')
                        ({{$analysis->laborant->login}})
                    @endcan
                </div>
            </x-ui.label>

            <x-ui.label
                key="laboratórium"
                center
            >
                {{ $analysis->lab->name }}
            </x-ui.label>
        </div>
    </div>
@stop
