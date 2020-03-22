@php
    if (session('success')) {
       $success = session('success');
       session()->remove('success');
    }
@endphp

@if ($errors->any() || isset($success))
    <div
        id="alert"
        class="flex justify-center mt-10 z-50 absolute w-screen"
    >
        <div
            class="bg-white w-96 shadow relative"
        >
            <div
                class="absolute close-btn top-0 right-0 w-4 h-4 flex justify-center text-gray-800 shadow hover:cursor-pointer"
                style="right: -1rem; background-color: RGBA(0, 0, 0, 0.30);"
            >
                <i class="fas fa-times"></i>
            </div>
            <div
                class="w-full h-2
                @if($errors->any()) bg-red-700 @else bg-green-500 @endif"
            >&nbsp;
            </div>

            @php
                if($errors->any())
                    $message = $errors->first();
                else
                    $message = $success[0];
            @endphp

            <div
                class="text-gray-800 p-3 text-center"
            >
                <p>
                    {{ $message }}
                </p>
            </div>
        </div>
    </div>
@endif

