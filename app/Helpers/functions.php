<?php

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
        return url()->current() === url($name, $parameters) ? 'active' : null;
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
        $arr1 = explode(" ", $str);
        $n = mb_strlen($arr1[1], 'utf-8');
        if ($n > 3) {
            return $arr1[0] . ' ' . Str::limit($arr1[1], 3, '.');
        }
        return $str;
    }
}
