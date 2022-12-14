<?php

namespace App\Http\Applications\Admin\Services\CallingBot\Dto;

class BottoDto implements BotDtoInterface
{
    /**
     * Название поставщика
     *
     * @var string
     */
    protected $name = 'botto';

    /**
     * Размер пачки клиентов, которые будут отправляться
     *
     * @var int
     */
    protected $chunkSize;

    /**
     * Частота отправки
     *
     * @var int
     */
    protected $frequency;

    /**
     * Идентификатор проекта
     *
     * @var int
     */
    protected $projectId;

    /**
     * Количество попыток дозвона
     *
     * @var int
     */
    protected $tries;

    /**
     * Интервал между звонками
     *
     * @var int
     */
    protected $period;

    /**
     * Номер аудио
     *
     * @var int
     */
    protected $materialId;

    /**
     * Номер меню
     *
     * @var int
     */
    protected $menuId;

    /**
     * @param array $fields
     * @return $this
     */
    public function parse(array $fields): BottoDto
    {
        $this->chunkSize = $fields['chunk_size_sending'];
        $this->frequency = $fields['frequency_sending'];
        $this->projectId = $fields['project_id'];
        $this->tries = $fields['dialing_attempts'];
        $this->period = $fields['interval_calls'];
        $this->materialId = $fields['audio_id'];
        $this->menuId = $fields['menu_id'];

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return [
            'chunk_size_sending' => $this->chunkSize,
            'frequency_sending' => $this->frequency,
            'project_id' => $this->projectId,
            'dialing_attempts' => $this->tries,
            'interval_calls' => $this->period,
            'audio_id' => $this->materialId,
            'menu_id' => $this->menuId
        ];
    }

    /**
     * @return int
     */
    public function getChunkSize(): int
    {
        return $this->chunkSize;
    }

    /**
     * @return int
     */
    public function getFrequency(): int
    {
        return $this->frequency;
    }

    /**
     * @return int
     */
    public function getProjectId(): int
    {
        return $this->projectId;
    }

    /**
     * @return int
     */
    public function getTries(): int
    {
        return $this->tries;
    }

    /**
     * @return int
     */
    public function getPeriod(): int
    {
        return $this->period;
    }

    /**
     * @return int
     */
    public function getMaterialId(): int
    {
        return $this->materialId;
    }

    /**
     * @return int
     */
    public function getMenuId(): int
    {
        return $this->menuId;
    }

    /**
     * @param int $value
     *
     * @return void
     */
    public function setChunkSize(int $value): void
    {
        $this->chunkSize = $value;
    }

    /**
     * @param int $value
     *
     * @return void
     */
    public function setFrequency(int $value): void
    {
        $this->frequency = $value;
    }

    /**
     * @param int $value
     *
     * @return void
     */
    public function setProjectId(int $value): void
    {
        $this->projectId = $value;
    }

    /**
     * @param int $value
     *
     * @return void
     */
    public function setTries(int $value): void
    {
        $this->tries = $value;
    }

    /**
     * @param int $value
     *
     * @return void
     */
    public function setPeriod(int $value): void
    {
        $this->period = $value;
    }

    /**
     * @param int $value
     *
     * @return void
     */
    public function setMaterialId(int $value): void
    {
        $this->materialId = $value;
    }

    /**
     * @param int $value
     *
     * @return void
     */
    public function setMenuId(int $value): void
    {
        $this->menuId = $value;
    }
}
