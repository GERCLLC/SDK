<?php

namespace GERCLLC\SDK\helper;

class IP
{
    /**
     * Перевірка валідності IPv4 та IPv6
     *
     * @param string $ipAddress
     * @return bool
     */
    public static function validateIpAddress(string $ipAddress): bool
    {
        // Перевірка IP на IPv4 та IPv6
        if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return true;
        } elseif (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return true;
        }

        return false;
    }
}