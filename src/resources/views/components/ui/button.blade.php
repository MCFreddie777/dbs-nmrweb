@props(['text','icon','class','primary','secondary','danger','type','href','disabled'])


@php
    $class_object = "flex justify-center items-center px-3 py-1 focus:outline-none ";
    if (isset ($disabled) && $disabled)
     $class_object .= 'bg-gray-400 text-white hover:bg-gray-400 hover:cursor-default ';
    else {
     $class_object .= 'hover:cursor-pointer ';
     if (isset($primary))
         $class_object .= 'bg-yellow-500 text-white hover:bg-yellow-400 ';
     if (isset($secondary))
         $class_object .= 'border border-gray-600 text-gray-600 bg-gray-200 ';
     if (isset($danger))
         $class_object .= 'border border-red-500 text-red-500 hover:bg-red-500 hover:text-white ';
    }
    if (isset($class))
     $class_object .= $class;
@endphp

@if(!isset($type) || (isset($type) && $type != 'link'))
    <div
        class="{{$class_object}}"
    >
        @isset($icon)
            <i class="{{ isset($text) ? 'mr-2': '' }} {{ $icon }}"/></i>
        @endisset

        @if(isset($type) && $type == 'submit')
            <input
                type="{{$type}}"
                value="{{$text}}"
                class="focus:outline-none bg-transparent hover:cursor-pointer"
                style="text-align: center;"
                {{ $attributes }}
            />
        @else
            <button
                class="focus:outline-none"
                style="text-align: center;"
                {{ $attributes }}
            >
                @isset($text)
                    {{ $text }}
                @endisset
            </button>
        @endif
    </div>
@else
    <a
        @if(isset($disabled) && $disabled)
        @else
        href="{{$href}}"
        @endif
        class="{{$class_object}}"
        style="text-align: center;"
        {{$attributes}}
    >
        @isset($icon)
            <i class="{{ isset($text) ? 'mr-2': '' }}  {{ $icon }}"/></i>
        @endisset($icon)

        @isset($text)
            {{ $text }}
        @endisset($text)
    </a>
@endif
