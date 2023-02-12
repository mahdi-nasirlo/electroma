<?php


if (!function_exists("activeClassProfile")) {
    function activeClassProfile($name, $needClass = true)
    {
        $return = $needClass ? " active show" : "true";

        if (request()->tab) {
            return (request()->tab === $name ? $return : '');
        }

        return ($name === "dashboard" ? $return : '');
    }
}
