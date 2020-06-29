<?php

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
     * @param $str
     * @return string
     */
    function numberFormat($str): string
    {
        return number_format($str, 0, '', ' ');
    }
}
if (!function_exists('loadImg')) {

    function loadImg()
    {
        $path = 'images/products'; // путь к директории с изображениями
        $extensions = array('png', 'jpg', 'jpeg', 'gif'); // показывать расширения

        $directoryIterator = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
        $iteratorIterator = new RecursiveIteratorIterator($directoryIterator, RecursiveIteratorIterator::LEAVES_ONLY);

        foreach ($iteratorIterator as $file) {
            if (in_array($file->getExtension(), $extensions)) {
                return $file->getPathname();
                continue;
            }
        }
    }
}
