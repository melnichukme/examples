<?php

namespace App\Http\Applications\Admin\Services\CallingBot;

class Bots
{
    /**
     * @var string
     */
    public static $botto = 'botto';

    /**
     * @return string[]
     */
    public static function getBotNames()
    {
        return [
            self::$botto
        ];
    }
}
