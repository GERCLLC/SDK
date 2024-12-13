<?php

namespace GERCLLC\SDK\helper;

class JSON
{
    /**
     * Перевіряє, чи є строка валідним JSON.
     *
     * @param string $json
     * @return bool
     */
    public static function isValidStringJson(string $json): bool
    {
        json_decode($json);
        return json_last_error() === JSON_ERROR_NONE;
    }
}