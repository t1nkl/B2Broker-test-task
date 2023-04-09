<?php

declare(strict_types=1);

if (!function_exists('uuid4')) {
    /**
     * @param  string|null  $data
     * @return string
     */
    function uuid4(string $data = null): string
    {
        $data = $data ?? random_bytes(16);
        assert(strlen($data) === 16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}

if (!function_exists('random_float')) {
    /**
     * @param  int  $min
     * @param  int  $max
     * @return float
     */
    function random_float(int $min = 0, int $max = 1): float
    {
        return $min + mt_rand() / mt_getrandmax() * ($max - $min);
    }
}
