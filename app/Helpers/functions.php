<?php

if (!function_exists('isCurrentRoute')) {
    /**
     * @param string $name
     * @param array $parameters
     * @return string|null
     */
    function isCurrentRoute(string $name, array $parameters = [])
    {
        return url()->current() === route($name, $parameters) ? 'active' : null;
    }
}
