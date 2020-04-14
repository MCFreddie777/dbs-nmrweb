@extends('master')

@section('title',$user->login)

@section('content')
    <div class="bg-white rounded-lg">
        <div class="p-4 pl-6">

            <h1
                class="text-2xl mb-6"
            >
                <span class="text-gray-600">Používateľ</span> {{ $user->login }}
            </h1>

            <x-ui.label
                key="rola"
                center
            >
                <p>
                    {{ $user->role_name }}
                </p>
            </x-ui.label>

            <x-ui.label
                key="počet vzoriek"
                center
            >
                <p>
                    {{ $user->samples }}
                </p>
            </x-ui.label>

            @if($user->role_name == 'laborant')

                <div class="mt-8 mb-5">
                    <p
                        class="inline pr-2 pb-1 uppercase border-b-2 border-yellow-400 font-bold text-gray-600 text-sm"
                    >
                        Štatistiky laboranta
                    </p>
                </div>

                <x-ui.label
                    key="analyzované vzorky"
                    center
                >
                    <p>
                        {{ $user->analyses }}
                    </p>
                </x-ui.label>

                <x-ui.label
                    key="priemerný čas analýzy"
                    center
                >
                    <p>
                        @if($user->avg_timestamp > 0)
                            {{ \Carbon\CarbonInterval::seconds($user->avg_timestamp)->cascade()->forHumans() }}
                        @else
                            -
                        @endif
                    </p>
                </x-ui.label>
            @endif
        </div>
    </div>
@stop
