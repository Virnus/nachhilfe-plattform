<?php

if (!function_exists('on_page')) {
    function on_page($path)
    {
        return request()->is($path);
    }
}

if (!function_exists('to_datatable_string')) {
    function to_datatable_string($collection, $id, $name)
    {
        $string = $collection->reduce(function ($string, $item) use ($id, $name) {
            return $string . "{$item[$id]}:{$item[$name]},";
        });

        return substr($string, 0, -1);
    }
}
