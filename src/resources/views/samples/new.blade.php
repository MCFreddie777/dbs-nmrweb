@extends('master')

@section('title','Nová vzorka')


@section('script')
@endsection

@section('content')
    <div class="bg-white rounded-lg">
        <div class="p-4 pl-6">
            <form action="/samples" method="POST">
                @csrf

                <input
                    type="text"
                    class="text-2xl border-b-2 border-gray-300 focus:outline-none focus:border-yellow-500"
                    name="name"
                    value="{{ old('name',"Nepomenovaná vzorka") }}"
                >

                {{-- mnozstvo --}}
                <x-ui.label
                    key="množstvo"
                    center
                    class="mt-10"
                    for="amount"
                >
                    <x-ui.input
                        name="amount"
                        type="number"
                        class="text-gray-700"
                        required
                        :value="old('amount')"
                    ></x-ui.input>
                    <span class="ml-3 text-gray-500 text-sm">ml</span>
                </x-ui.label>

                {{-- struktura --}}
                <x-ui.label
                    key="štruktúra"
                    for="structure"
                    class="h-64 w-full"
                >
                    <div class="w-4/5">
                        <div id="jsme" class="flex w-full h-full justify-center mx-auto"></div>
                    </div>
                </x-ui.label>

                {{-- spectrometer --}}
                <x-ui.label
                    key="spektrometer"
                    center
                    for="spectrometer"
                >
                    <x-ui.select
                        name="spectrometer"
                        :items="$spectrometers"
                        class="text-gray-700 w-1/4"
                    ></x-ui.select>
                </x-ui.label>

                {{-- rozpustadlo --}}
                <x-ui.label
                    key="rozpúštadlo"
                    center
                    for="solvent"
                >
                    <x-ui.select
                        name="solvent"
                        :items="$solvents"
                        class="text-gray-700 w-1/4"
                    ></x-ui.select>
                </x-ui.label>

                {{-- grant --}}
                <x-ui.label
                    key="grant"
                    center
                    for="grant"
                >
                    <x-ui.select
                        name="grant"
                        :items="$grants"
                        class="text-gray-700 w-1/4"
                    ></x-ui.select>
                </x-ui.label>

                {{-- poznamka --}}
                <x-ui.label
                    key="poznámka"
                    for="note"
                >
                    <textarea
                        name="note"
                        class="text-gray-700 w-2/3 bg-gray-300 p-2 rounded focus:outline-none placeholder-gray-500"
                        rows="4"
                        required
                    >{{ old('note') }}</textarea>
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
