<?php

namespace App\Tests\Constant;

final class Constant
{
    public const USER = 'schantave@bocasay.com';

    /**
     * @param string $username
     * @return array
     */
    public static function getInfoAuthenticate(string $username): array
    {
        return [
            'login' => $username ?: self::USER,
        ];
    }
}
