<?php

namespace App\Http\Applications\Admin\Services\CallingBot;

use App\Http\Applications\Admin\Services\CallingBot\Dto\BotDtoInterface;
use App\Http\Applications\Admin\Services\CallingBot\Dto\BottoDto;

abstract class FactoryAbstract
{
    /**
     * @param string $callingBotName
     * @return BotDtoInterface
     * @throws \Exception
     */
    public static function make(string $callingBotName): BotDtoInterface
    {
        switch ($callingBotName) {
            case Bots::$botto:
                return new BottoDto();
            default:
                throw new \Exception('Not correct bot provider.');
        }
    }
}
