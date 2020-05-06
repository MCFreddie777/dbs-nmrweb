@extends('master')

@section('title',$grant->name)

@section('content')
    <div class="bg-white rounded-lg">
        <div class="p-4 pl-6">

            <h1
                class="text-2xl mb-6"
            >
                <span class="text-gray-600">Grant</span> {{ $grant->name }}
            </h1>

            <x-ui.label
                key="počet vzoriek"
                center
            >
                <a
                    href="/samples?grant={{$grant->id}}"
                    class="text-blue-600 hover:underline"
                >
                    {{ $grant->samples->count() }}
                </a>
            </x-ui.label>

            <x-ui.label
                key="administrátori grantu"
                center
            >
                @can('admin')
                    @foreach($grant->users as $user)
                        @if ($user->id != Auth::id())
                            <a
                                class="text-blue-600 hover:underline"
                                href="{{ url('/users?search=') }}{{$user->login}}"
                            >
                                {{ $user->login }}
                            </a>
                        @else
                            <p>
                                {{ $user->login }} (Vy)
                            </p>
                        @endif
                    @endforeach
                @else
                    <p>
                        {{ $user->login }}
                    </p>
                @endcan
            </x-ui.label>

        </div>
    </div>
@stop
