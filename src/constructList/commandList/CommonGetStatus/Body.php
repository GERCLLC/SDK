<?php

namespace GERCLLC\SDK\constructList\commandList\CommonGetStatus;

use GERCLLC\SDK\abstracts\AbstractCommand;

class Body extends AbstractCommand
{
    /**
     * Ідентифікатор платежу
     *
     * @var int $oper_id
     */
    protected $oper_id;

    /**
     * Ідентифікатор партнера
     *
     * @var int $partner_id
     */
    protected $partner_id;

    /** @var array $dataArray */
    protected $dataArray = [];

    /**
     * @return int
     */
    public function getOperId()
    {
        return $this->oper_id;
    }

    /**
     * @param int $oper_id
     * @return $this
     */
    public function setOperId(int $oper_id): self
    {
        $this->oper_id = $oper_id;

        return $this;
    }

    /**
     * @return int
     */
    public function getPartnerId()
    {
        return $this->partner_id;
    }

    /**
     * @param int $partner_id
     * @return $this
     */
    public function setPartnerId(int $partner_id): self
    {
        $this->partner_id = $partner_id;

        return $this;
    }

    /**
     * @return array
     */
    public function getArray(): array
    {
        if (!empty($this->getOperId())) {
            $this->dataArray['oper_id'] = $this->getOperId();
        }

        if (!empty($this->getPartnerId())) {
            $this->dataArray['partner_id'] = $this->getPartnerId();
        }

        return $this->dataArray;
    }

    public function valid(): bool
    {
        if (empty($this->getOperId())) {
            return false;
        }

        if (empty($this->getPartnerId())) {
            return false;
        }

        return true;
    }
}