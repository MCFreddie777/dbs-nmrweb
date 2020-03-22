<?php

function tableRowsClassObject($options, $index, $misc = true)
{
    $classObject = "";
    if ($misc)
        $classObject .= "py-3 border-b border-gray-200 ";
    if (isset($options['layout'][$index]) && isset($options['layout'][$index]['width']))
        $classObject .= "w-{$options['layout'][$index]['width']} ";
    if (isset($options['layout'][$index]) && isset($options['layout'][$index]['width-sm']))
        $classObject .= "sm:w-{$options['layout'][$index]['width-sm']} ";
    if (isset($options['layout'][$index]) && isset($options['layout'][$index]['left']))
        $classObject .= "first:pl-6 text-left justify-start";

    return $classObject;
}
