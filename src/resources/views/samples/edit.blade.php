@extends('master')

@section('title','Upraviť vzorku '.$sample->name)

@section('script')
    <script src="{{ asset('js/ext/jsme.nocache.js') }}"></script>
    <script defer>
        // JSApplet for chemical structures
        setTimeout(function () {
            window.jsmeApplet = new JSApplet.JSME("jsme", {
                options: "newlook"
            });
            window.jsmeApplet.readMolFile(`{{ $sample->structure }}`);
        }, 750);

        // read applet into hidden textarea before submit
        const sampleForm = document.querySelector('#sampleForm');
        sampleForm.addEventListener("submit", (event) => {
            event.preventDefault();
            const data = window.jsmeApplet.molFile();
            document.querySelector('textarea[name="structure"]').value = data;
            sampleForm.submit();
        });
    </script>
@endsection

@section('content')
    <div class="bg-white rounded-lg">
        <div class="p-4 pl-6">
            <form action="/samples/{{$sample->id}}" method="POST" id="sampleForm">
                @method('put')
                @csrf
                <input
                    type="text"
                    class="text-2xl border-b-2 border-gray-300 focus:outline-none focus:border-yellow-500"
                    name="name"
                    value="{{ old('name',$sample->name) }}"
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
                        :value="old('amount',$sample->amount)"
                    ></x-ui.input>
                    <span class="ml-3 text-gray-500 text-sm">ml</span>
                </x-ui.label>

                {{-- struktura --}}
                <x-ui.label
                    key="štruktúra"
                    for="structure"
                    class="h-64 w-full"
                >
                    <textarea name="structure" hidden></textarea>
                    <div class="w-4/6">
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
                        :selected="$sample->spectrometer->id"
                        class="text-gray-700 w-1/4"
                        required
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
                        :selected="$sample->solvent->id"
                        class="text-gray-700 w-1/4"
                        required
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
                        :selected="$sample->grant->id ?? NULL"
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
                    >{{ old('note',$sample->note) }}</textarea>
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
