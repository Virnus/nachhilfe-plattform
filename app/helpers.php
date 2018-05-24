<?php

if (!function_exists('on_page')) {
    /**
     * Testet ob der gebene String mit dem Pfad übereinstimmt
     * @param  String $path
     * @return boolean
     */
    function on_page($path)
    {
        return request()->is($path);
    }
}

if (!function_exists('to_datatable_string')) {
    /**
     * Verwandelt die gegebende Collection in einen lesbaren String
     * @param  Collection $collection
     * @param   int $id
     * @param  string $name
     * @return string
     */
    function to_datatable_string($collection, $id, $name)
    {
        $string = $collection->reduce(function ($string, $item) use ($id, $name) {
            return $string . "{$item[$id]}:{$item[$name]},";
        });

        return substr($string, 0, -1);
    }
}
