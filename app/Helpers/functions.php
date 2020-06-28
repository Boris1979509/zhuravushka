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
