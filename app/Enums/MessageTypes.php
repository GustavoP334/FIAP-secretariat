<?php

namespace App\Enums;

class MessageTypes
{
    public const ERROR = 'Error';
    public const SUCCESS = 'Success';

    public static function values(): array
    {
        return [
            self::ERROR,
            self::SUCCESS
        ];
    }
}
