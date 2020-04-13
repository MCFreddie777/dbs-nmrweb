@extends('master')

@section('title','Nové laboratórium')

@section('content')
    <div class="bg-white rounded-lg">
        <div class="p-4 pl-6">
            <form action="/administration/labs" method="POST">
                @csrf

                <input
                    type="text"
                    class="text-2xl border-b-2 border-gray-300 focus:outline-none focus:border-yellow-500"
                    name="name"
                    value="{{ old('name','LAB-01') }}"
                    required
                >

                {{-- adresa --}}
                <x-ui.label
                    key="adresa"
                    class="mt-10"
                    for="address"
                >
                    <textarea
                        name="address"
                        class="text-gray-700 w-2/3 bg-gray-300 p-2 rounded focus:outline-none placeholder-gray-500"
                        rows="4"
                    >{{ old('address') }}</textarea>
                </x-ui.label>

                <div class="flex flex-row justify-end mt-5">
                    <x-ui.button
                        class="rounded-full w-24"
                        text="Uložiť"
                        primary
                        type="submit"
                    ></x-ui.button>
                </div>
            </form>
        </div>
    </div>
@stop
