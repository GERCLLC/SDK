<?php

namespace GERCLLC\SDK\constructList\commandList\CommonGetID;

use GERCLLC\SDK\abstracts\AbstractCommand;

class PayData extends AbstractCommand
{
    /**
     * Ідентифікатор точки.
     * Видається менеджером ГЕРЦ.
     * Може бути прив'язаний до банківських реквізитів.
     * Більш детально див. розділ "Загальна інформація"
     *
     * @var int $point_id
     */
    protected $point_id;

    /**
     * Сума платежу за цією точкою (у копійках)
     *
     * @var int $amount
     */
    protected $amount;

    /**
     * Опис платежу/Призначення платежу
     *
     * @var string $description
     */
    protected $description;

    /**
     * Додаткові дані для зовнішних систем. Рядок, зашифрований у Base64
     *
     * @var string $extra_params
     */
    protected $extra_params;

    /**
     * ПІБ вигодонабувача послуги
     *
     * @var string $payer
     */
    protected $payer;

    /** @var array $dataArray */
    protected $dataArray = [];

    /**
     * @return int
     */
    public function getPointId(): int
    {
        return $this->point_id;
    }

    /**
     * @param int $point_id
     * @return $this
     */
    public function setPointId(int $point_id): self
    {
        $this->point_id = $point_id;

        return $this;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     * @return $this
     */
    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getExtraParams(): string
    {
        return $this->extra_params;
    }

    /**
     * @param string $extra_params
     * @return $this
     */
    public function setExtraParams(string $extra_params): self
    {
        $this->extra_params = $extra_params;

        return $this;
    }

    /**
     * @return string
     */
    public function getPayer(): string
    {
        return $this->payer;
    }

    /**
     * @param string $payer
     * @return $this
     */
    public function setPayer(string $payer): self
    {
        $this->payer = $payer;

        return $this;
    }

    /**
     * @return array
     */
    public function getArray(): array
    {
        if (!empty($this->getPointId())) {
            $this->dataArray['point_id'] = $this->getPointId();
        }

        if (!empty($this->getAmount())) {
            $this->dataArray['amount'] = $this->getAmount();
        }

        if (!empty($this->getDescription())) {
            $this->dataArray['description'] = $this->getDescription();
        }

        if (!empty($this->getExtraParams())) {
            $this->dataArray['extra_params'] = $this->getExtraParams();
        }

        if (!empty($this->getPayer())) {
            $this->dataArray['payer'] = $this->getPayer();
        }

        return $this->dataArray;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        if (empty($this->getPointId())) {
            return false;
        }

        if (empty($this->getAmount())) {
            return false;
        }

        return true;
    }
}