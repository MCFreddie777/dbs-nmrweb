<div
    class="flex h-16 justify-between shadow border-b border-gray-400 items-center "
    style="box-sizing: content-box;"
>
    <p class="pl-8 text-xl">
        Centrálne laboratóriá
    </p>
    <div
        class="flex justify-end h-full"
    >
        <a
            href="/change-password"
            class="flex px-5 items-center hover:cursor-pointer hover:bg-gray-100"
        >
            <x-user.circle
                :name="Auth::user()->login"
            ></x-user.circle>
            <span class="pl-3 text-gray-900">
                {{  Auth::user()->login }}
            </span>
        </a>
    </div>
</div>
