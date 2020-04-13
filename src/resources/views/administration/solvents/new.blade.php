@extends('master')

@section('title','Nové rozpúštadlo')

@section('content')
    <div class="bg-white rounded-lg">
        <div class="p-4 pl-6">
            <form action="/administration/solvents" method="POST">
                @csrf

                <input
                    type="text"
                    class="text-2xl border-b-2 border-gray-300 focus:outline-none focus:border-yellow-500"
                    name="name"
                    value="{{ old('name','Nové rozpúštadlo') }}"
                    required
                >

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
