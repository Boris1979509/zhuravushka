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
     * @param string $name
     * @return string
     */
    function fileExist($name): string
    {

        $info = pathinfo($name);
        if (!empty($info['extension'])) {
            // if the file already contains an extension returns it
            return $name;
        }
        $filename = $info['filename'];
        $len = strlen($filename);
        // open the folder
        $dh = opendir($info['dirname']);
        if (!$dh) {
            return false;
        }
        // scan each file in the folder
        while (($file = readdir($dh)) !== false) {
            if (strncasecmp($file, $filename, $len) === 0) {
                if (strlen($name) > $len) {
                    // if name contains a directory part
                    $name = substr($name, 0, strlen($name) - $len) . $file;
                } else {
                    // if the name is at the path root
                    $name = $file;
                }
                closedir($dh);
                return asset($name);
            }
        }
        // file not found
        closedir($dh);
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
        return $collect->map(static function ($item) {
            return $item->id;
        })->toArray();
    }
}
