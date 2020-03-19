@extends('layouts.app')

@section('master')
    <div class="h-screen bg-white flex">
        @include('_partials.navigation')
        <div
            class="flex flex-col flex-1 h-screen max-h-full overflow-y-auto"
        >
            @include('_partials.header')
            <div
                class="flex flex-col flex-1 bg-gray-300 p-8 overflow-y-auto"
                style="max-height: calc(100vh - 65px);"
            >
                @yield('content')
            </div>
        </div>
    </div>
@endsection
