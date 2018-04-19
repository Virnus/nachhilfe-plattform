<?php

if (!function_exists('on_page')) {
    function on_page($path)
    {
        return request()->is($path);
    }
}
