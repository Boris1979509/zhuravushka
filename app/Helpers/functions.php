<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Jenssegers\Date\Date;

if (!function_exists('isCurrentRoute')) {
    /**
     * @param string $name
     * @param array $parameters
     * @return string|null
     */
    function isCurrentRoute(string $name, array $parameters = [])
    {
        // get queries with parameters
        return url()->full() === route($name, $parameters) ? 'active' : null;
    }
}
if (!function_exists('cart')) {
    /**
     * @return bool
     */
    function cart()
    {
        return session()->has('orderId') ? true : false;
    }
}
if (!function_exists('numberFormat')) {
    /**
     * @param string $str
     * @return string
     */
    function numberFormat($str): string
    {
        return number_format($str, 0, '', ' ');
    }
}
if (!function_exists('parseDate')) {
    /**
     * @param string $str
     * @return Date
     */
    function parseDate($str)
    {

        return Jenssegers\Date\Date::parse($str);
    }
}
if (!function_exists('limitMonth')) {
    /**
     * @param $str
     * @return string
     */
    function limitMonth($str)
    {
        $arr1 = explode(' ', $str);
        $n = mb_strlen($arr1[1], 'utf-8');
        if ($n > 3) {
            return $arr1[0] . ' ' . Str::limit($arr1[1], 3, '.');
        }
        return $str;
    }
}
if (!function_exists('fileExist')) {
    /**
     * @param $path
     * @return string
     */
    function fileExist($path): string
    {
        if (file_exists(public_path($path))) {
            return asset($path);
        }
        return asset('images/nophoto.png');
    }
}
if (!function_exists('getIdsFromCollect')) {
    /**
     * @param $collect
     * @return array
     */
    function getIdsFromCollect($collect): array
    {
        return $collect->map(function ($item) {
            return $item->id;
        })->toArray();
    }
}
