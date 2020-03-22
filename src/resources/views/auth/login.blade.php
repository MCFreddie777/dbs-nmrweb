@extends('layouts.app')

@section('title','Prihlásenie')

@section('master')

    <div class="h-full flex bg-gray-200">
        <div class="fixed flex w-full shadow-lg bg-yellow-500 p-4">
            <a href="/">
                <img src="/img/logo-extended.png" alt="STU FCHPT logo" class="w-3/4">
            </a>
        </div>

        <div class="mx-auto flex justify-center items-center ">

            <div class="w-96 bg-white rounded-lg shadow-xl p-8">

                <h1 class="text-gray-800 text-3xl font-bold pt-3 text-center">Vitajte</h1>
                <p class="text-center text-gray-700">Pokračujte prosím prihlásením sa</p>

                <form method="POST" action="/login" class="relative">
                    @csrf
                    @error('login')
                    <p
                        class="text-red-500 absolute text-sm"
                        style="top:-2rem"
                    >
                        @if(isset($message))
                            <span>
                                {{ $message }}
                            </span>
                        @else
                            <span>
                                 Niekde nastala chyba. Skúste <!--
                            --><a
                                    href="javascript:location.reload()"
                                    class="text-blue-500 underline"
                                >obnoviť stránku<!--
                            --></a>.
                            </span>
                        @endif

                    </p>
                    @enderror

                    <div
                        class="relative mt-16 border-2 rounded border-white"
                    >
                        <label
                            for="login"
                            class="uppercase text-gray-600 text-xs font-bold absolute pl-3 pt-2"
                        >
                            Login
                        </label>
                        <x-ui.input
                            type="text"
                            name="login"
                            required="true"
                            autofocus="true"
                            placeholder="vasa@adresa.sk"
                            labeled
                            w-full
                        >
                        </x-ui.input>
                    </div>

                    <div
                        class="relative mt-3 w-100 border-2 rounded border-white"
                    >
                        <label
                            for="password"
                            class="uppercase text-gray-600 text-xs font-bold absolute pl-3 pt-2"
                        >
                            Heslo
                        </label>

                        <x-ui.input
                            type="password"
                            name="password"
                            required="true"
                            placeholder="*********"
                            labeled
                            w-full
                            error-key="login"
                        >
                        </x-ui.input>

                    </div>
                    <div class="pt-8 text-center">
                        <button
                            type="submit"
                            class="bg-yellow-500 py-2 px-6 text-center rounded-full text-white mx-auto hover:bg-yellow-400 focus:outline-none"
                        >
                            Prihlásiť sa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
