@extends('master')

@section('title','Nový používateľ')

@section('content')
    <div class="bg-white rounded-lg">
        <div class="p-4 pl-6">
            <form action="/users" method="POST">
                @csrf

                <h1
                    class="text-2xl"
                >
                    Nový používateľ
                </h1>

                <x-ui.label
                    key="login"
                    center
                    class="mt-10"
                    for="login"
                >
                    <x-ui.input
                        name="login"
                        type="text"
                        class="text-gray-700"
                        required
                        :value="old('login')"
                    ></x-ui.input>
                </x-ui.label>

                <x-ui.label
                    key="rola"
                    center
                    for="role_id"
                >
                    <x-ui.select
                        name="role_id"
                        :items="$roles"
                        class="text-gray-700 w-1/4"
                        required
                    ></x-ui.select>
                </x-ui.label>

                <x-ui.label
                    key="heslo"
                    center
                    for="password"
                >
                    <x-ui.input
                        type="password"
                        name="password"
                        :required="true"
                        placeholder="••••••••"
                        autocomplete="off"
                    ></x-ui.input>
                </x-ui.label>

                <x-ui.label
                    key="potvrdiť heslo"
                    center
                    for="confirm_password"
                >
                    <x-ui.input
                        type="password"
                        name="password_confirmation"
                        :required="true"
                        placeholder="••••••••"
                        autocomplete="off"
                        error-key="password"
                    ></x-ui.input>
                </x-ui.label>


                <div class="flex flex-row justify-end mt-5">
                    <x-ui.button
                        class="rounded-full w-24"
                        text="Vytvoriť"
                        primary
                        type="submit"
                    ></x-ui.button>
                </div>
            </form>
        </div>
    </div>
@stop
