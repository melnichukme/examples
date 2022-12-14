<?php

namespace App\Http\Applications\Admin\Services\CallingBot\Dto;

interface BotDtoInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return array
     */
    public function getFields(): array;
}
