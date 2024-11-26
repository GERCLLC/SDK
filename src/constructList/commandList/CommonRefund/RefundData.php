<?php

namespace GERCLLC\SDK\constructList\commandList\CommonRefund;

use GERCLLC\SDK\abstracts\AbstractCommand;

class RefundData extends AbstractCommand
{
    /**
     * @var int $point_id
     */
    protected $point_id;

    /**
     * @var int $record_id
     */
    protected $record_id;

    /** @var array $dataArray */
    protected $dataArray = [];

    /**
     * @var int $amount
     */
    protected $amount;

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
    public function getRecordId(): int
    {
        return $this->record_id;
    }

    /**
     * @param int $record_id
     * @return $this
     */
    public function setRecordId(int $record_id): self
    {
        $this->record_id = $record_id;

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

    public function getArray(): array
    {
        if (!empty($this->getPointId())) {
            $this->dataArray['point_id'] = $this->getPointId();
        }

        if (!empty($this->getRecordId())) {
            $this->dataArray['record_id'] = $this->getRecordId();
        }

        if (!empty($this->getAmount())) {
            $this->dataArray['amount'] = $this->getAmount();
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

        if (empty($this->getRecordId())) {
            return false;
        }

        if (empty($this->getAmount())) {
            return false;
        }

        return true;
    }
}