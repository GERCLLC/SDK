<?php

namespace GERCLLC\SDK\constructList\commandList\CommonGetInfo;

use GERCLLC\SDK\abstracts\AbstractCommand;
use GERCLLC\SDK\constructList\Config;

class Body extends AbstractCommand
{
    /**
     * Ідентифікатор партнера
     *
     * @var int $partner_id
     */
    protected $partner_id;

    /**
     * Перелік точок продажів партнера, через які проводяться платежі.
     * Має бути, як мінімум одна точка!
     *
     * @var array $payData
     */
    protected $payData = [];

    /** @var array $dataArray */
    protected $dataArray = [];

    /**
     * @return int
     */
    public function getPartnerId(): int
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
    public function getPayData(): array
    {
        return $this->payData;
    }

    /**
     * @param PayData $payData
     * @return $this
     */
    public function addPayData(PayData $payData): self
    {
        $this->payData[] = $payData->getArray();

        return $this;
    }

    /**
     * @return array
     */
    public function getArray(): array
    {
        if (!empty($this->getPartnerId())) {
            $this->dataArray['partner_id'] = $this->getPartnerId();
        }

        if (!empty($this->getPayData())) {
            $this->dataArray['paydata'] = $this->getPayData();
        }

        $this->dataArray['api_ver'] = Config::getInstance()->getApiVer();

        return $this->dataArray;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        if (empty($this->getPartnerId())) {
            return false;
        }

        return true;
    }
}