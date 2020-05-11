@extends('master')

@section('title','Nová analýza')

@section('content')
    <div class="bg-white rounded-lg">
        <div class="p-4 pl-6">
            <form action="/analyses" method="POST">
                @csrf

                <h1
                    class="text-2xl"
                >
                    Analyzovať vzorku
                </h1>

                <input type="hidden" name="sample" value="{{$sample->id}}">

                <x-ui.label
                    key="vzorka"
                    center
                    class="mt-10"
                    for="sample_id"
                >
                    <a
                        class="text-blue-600 hover:underline"
                        href="{{ url('/samples',$sample->id) }}"
                    >
                        {{ ucfirst($sample->name) }}
                    </a>
                </x-ui.label>

                <x-ui.label
                    key="laboratórium"
                    center
                    for="lab"
                >
                    <x-ui.select
                        name="lab"
                        :items="$labs"
                        class="text-gray-700 w-1/4"
                        required
                    ></x-ui.select>
                </x-ui.label>

                <div class="flex flex-row justify-end mt-5">
                    <x-ui.button
                        class="rounded-full w-24"
                        text="Analyzovať"
                        primary
                        type="submit"
                    ></x-ui.button>
                </div>
            </form>
        </div>
    </div>
@stop
