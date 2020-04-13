@extends('master')

@section('title','Správa laboratórií')

@section('content')

    <h1 class="text-2xl mb-3">Správa laboratórií</h1>

    <div class="flex flex-row">


        {{-- Spektrometre --}}
        <a
            href="{{ url()->current() }}/spectrometers"
            class="mb-5 mr-5"
        >
            <div
                class="flex flex-col bg-white h-64 w-64 pt-12 items-center group "
            >
                <i class="fas fa-eye-dropper fa-2x text-gray-600 group-hover:text-yellow-500"></i>
                <p
                    class="text-xl mt-8"
                >
                    Spektrometre
                </p>
                <p class="text-gray-600 mt-2 px-5 text-center">
                    Vyberte možnosť pre správu spektrometrov laboratória
                </p>
            </div>
        </a>

        {{-- Rozpúšťadlá --}}
        <a
            href="{{ url()->current() }}/solvents"
            class="mb-5 mr-5"
        >
            <div
                class="flex flex-col bg-white h-64 w-64 pt-12 items-center group"
            >
                <i class="fas fa-flask fa-2x text-gray-600 group-hover:text-yellow-500"></i>
                <p
                    class="text-xl mt-8"
                >
                    Rozpúšťadla
                </p>
                <p class="text-gray-600 mt-2 px-5 text-center">
                    Vytvárajte, upravujte rozpúšťadlá
                </p>
            </div>
        </a>

        {{-- Laboratóriá --}}
        <a
            href="{{ url()->current() }}/labs"
        >
            <div
                class="flex flex-col bg-white h-64 w-64 pt-12 items-center group"
            >
                <i class="fas fa-warehouse fa-2x text-gray-600 group-hover:text-yellow-500"></i>
                <p
                    class="text-xl mt-8"
                >
                    Laboratóriá
                </p>
                <p class="text-gray-600 mt-2 px-5 text-center">
                    Spravujte názvy a adresy laboratórií
                </p>
            </div>
        </a>
    </div>
@stop
