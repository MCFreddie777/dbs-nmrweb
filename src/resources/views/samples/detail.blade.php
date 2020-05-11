@extends('master')

@section('title',$sample->name)

@section('script')
    <script src="{{ asset('js/ext/jsme.nocache.js') }}"></script>
    <script defer>
        // JSApplet for chemical structures
        setTimeout(function () {
            window.jsmeApplet = new JSApplet.JSME("jsme", {
                options: "newlook,depict"
            });
            window.jsmeApplet.readMolFile(`{{ $sample->structure }}`);
        }, 750);
    </script>
@endsection

@section('content')
    <div class="bg-white rounded-lg">
        <div class="p-4 pl-6">

            <h1
                class="text-2xl mb-10"
            >
                {{ $sample->name }}
            </h1>

            @if($sample->user->id != Auth::id())
                <x-ui.label
                    key="vytvoril"
                    center
                    for="amount"
                >
                    @can('admin')
                        <a
                            class="text-blue-600 hover:underline"
                            href="{{ url('/users',$sample->user->id) }}"
                        >
                            {{ $sample->user->login }}
                        </a>
                    @else
                        <p>
                            {{ $sample->user->login }}
                        </p>
                    @endcan
                </x-ui.label>
            @endif

            {{-- mnozstvo --}}
            <x-ui.label
                key="množstvo"
                center
                for="amount"
            >
                <p
                >
                    {{ $sample->amount }} ml
                </p>
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
                <p
                >
                    {{ $sample->spectrometer->name }} ({{ $sample->spectrometer->type }})
                </p>
            </x-ui.label>

            {{-- rozpustadlo --}}
            <x-ui.label
                key="rozpúštadlo"
                center
                for="solvent"
            >
                <p
                >
                    {{ $sample->solvent->name }}
                </p>
            </x-ui.label>

            {{-- grant --}}
            <x-ui.label
                key="grant"
                center
                for="grant"
            >
                @isset($sample->grant)
                    {{ $sample->grant->name }}
                @else
                    <p class="text-gray-500">Nie</p>
                @endisset

            </x-ui.label>

            {{-- poznamka --}}
            <x-ui.label
                key="poznámka"
                for="note"
            >
                @isset($sample->note)
                    <p>{{ $sample->note }}</p>
                @endisset
            </x-ui.label>

            {{-- analyza --}}
            <x-ui.label
                key="analýza"
                for="note"
            >
                @isset($sample->analysis)
                    @if(Gate::any(['admin','laborant']) || $sample->user_id == Auth::id())
                        <a
                            class="text-blue-600 hover:underline"
                            href="{{ url('/analyses',$sample->analysis->id) }}"
                        >
                            {{ ucfirst($sample->analysis->status()->name) }} ({{ $sample->analysis->user->login }})
                        </a>
                    @else
                        <p>
                            {{ ucfirst($sample->analysis->status()->name) }} ({{ $sample->analysis->user->login }})
                        </p>
                    @endif
                @else
                    <p class="text-gray-500">Nepriradené</p>
                @endisset
            </x-ui.label>

            @can('laborant')
                @csrf
                <input type="hidden" name="sample_id" value="{{ $sample->id }}">
                <div class="flex flex-row justify-end mt-5">
                    <x-ui.button
                        class="rounded-full"
                        text="Analyzovať"
                        primary
                        type="link"
                        :href="url('/analyses/new').'?sample='.$sample->id"
                    ></x-ui.button>
                </div>
            @endcan
        </div>
    </div>
@stop
