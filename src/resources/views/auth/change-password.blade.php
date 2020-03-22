@extends('master')

@section('title','Zmena hesla')

@section('content')
    <div class="bg-white rounded-lg">
        <div class="p-4 pl-6">
            <h1 class="text-2xl mb-4">
                Zmena hesla
            </h1>

            <form action="#" method="POST">
                @csrf

                <div class="flex items-center pb-3">
                    <label
                        class="uppercase font-bold text-gray-500 text-sm block w-32 mr-5"
                        for="password"
                    >
                        Aktuálne Heslo
                    </label>
                    <x-ui.input
                        name="old_password"
                        type="password"
                        class="relative mt-16 border-2 rounded border-white"
                        :required="true"
                        placeholder="••••••••"
                        error-key="password"
                    ></x-ui.input>
                </div>

                <div class="flex items-center pb-3 w-full">
                    <label
                        class="block uppercase font-bold text-gray-500 text-sm block w-32 mr-5"
                        for="password"
                    >
                        Nové Heslo
                    </label>
                    <x-ui.input
                        type="password"
                        name="password"
                        :required="true"
                        placeholder="••••••••"
                        autocomplete="off"
                    ></x-ui.input>
                </div>

                <div class="flex items-center pb-3">
                    <label
                        class="uppercase font-bold text-gray-500 text-sm block w-32 mr-5"
                        for="confirm_password"
                    >
                        Potvrdiť heslo
                    </label>
                    <x-ui.input
                        type="password"
                        name="password_confirmation"
                        :required="true"
                        placeholder="••••••••"
                        autocomplete="off"
                        error-key="password"
                    ></x-ui.input>
                </div>

                <x-ui.button
                    class="rounded-full mt-5 w-20"
                    text="Uložiť"
                    primary
                    type="submit"
                ></x-ui.button>
            </form>
        </div>
    </div>
@stop
