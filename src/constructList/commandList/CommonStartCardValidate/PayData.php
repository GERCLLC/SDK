<?php

namespace GERCLLC\SDK\constructList\commandList\CommonStartCardValidate;

use GERCLLC\SDK\abstracts\AbstractCommand;

class PayData extends AbstractCommand
{
    /**
     *  Ідентифікатор точки
     *
     * @var int $point_id
     */
    protected $point_id;

    /**
     * Сума платежу за цією точкою
     *
     * @var int $amount
     */
    protected $amount;

    /**
     * Опис платежу
     *
     * @var string $description
     */
    protected $description;

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

        return $this->dataArray;
    }

    public function valid(): bool
    {
        if (empty($this->getPointId())) {
            return false;
        }

        if (empty($this->getAmount())) {
            return false;
        }

        if (empty($this->getDescription())) {
            return false;
        }

        return true;
    }
}