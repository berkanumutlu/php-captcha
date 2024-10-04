<?php

namespace App\Library\Functions;

/**
 * @param $key
 * @return mixed|null
 */
function get_config($key = null)
{
    $config = require './config/captcha.php';
    if ($key === null) {
        return $config;
    }
    $keys = explode('.', $key);
    foreach ($keys as $innerKey) {
        if (isset($config[$innerKey])) {
            $config = $config[$innerKey];
        } else {
            return null;
        }
    }
    return $config;
}

/**
 * @return array|false|mixed|string
 */
function get_ip_address()
{
    if (getenv('HTTP_CLIENT_IP')) {
        $ip_address = getenv('HTTP_CLIENT_IP');
    } else {
        if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip_address = getenv('HTTP_X_FORWARDED_FOR');
            if (strpos($ip_address, ',')) {
                $exploded_array = explode(',', $ip_address);
                $ip_address = trim(current($exploded_array));
            }
        } else {
            $ip_address = getenv('REMOTE_ADDR');
        }
    }
    if (strpos($ip_address, ',')) {
        $ip_address = explode(',', $ip_address);
        $ip_address = current($ip_address);
    }
    return $ip_address;
}
