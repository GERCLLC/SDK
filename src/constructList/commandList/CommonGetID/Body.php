<?php

namespace GERCLLC\SDK\constructList\commandList\CommonGetID;

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
     * URL редиректа користувача після проведення платежу
     *
     * @var string $backref_url
     */
    protected $backref_url = '';

    /**
     * URL нотифікації
     *
     * @var string $notify_url
     */
    protected $notify_url = '';

    /**
     * paydata є обов'язковим і містить перелік точок продажу партнера (від 1 до N),
     * через які проводяться платежі. Цей параметр є масивом,
     * тобто може містити кілька елементів, в залежності від кількості точок продажу.
     * Для кращого розуміння формату запиту, рекомендуємо скористатися прикладами
     * запитів getID, які наведені у блоці Example Request.
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
     * @return string
     */
    public function getBackrefUrl(): string
    {
        return $this->backref_url;
    }

    /**
     * @param string $backref_url
     * @return $this
     */
    public function setBackrefUrl(string $backref_url): self
    {
        $this->backref_url = $backref_url;

        return $this;
    }

    /**
     * @return string
     */
    public function getNotifyUrl(): string
    {
        return $this->notify_url;
    }

    /**
     * @param string $notify_url
     * @return $this
     */
    public function setNotifyUrl(string $notify_url): self
    {
        $this->notify_url = $notify_url;

        return $this;
    }

    /**
     * @return array
     */
    public function getPayDataArray(): array
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

        if (!empty($this->getBackrefUrl())) {
            $this->dataArray['backref_url'] = $this->getBackrefUrl();
        }

        if (!empty($this->getNotifyUrl())) {
            $this->dataArray['notify_url'] = $this->getNotifyUrl();
        }

        if (!empty($this->getPayDataArray())) {
            $this->dataArray['paydata'] = $this->getPayDataArray();
        }

        $this->dataArray['api_ver'] = Config::getInstance()->getApiVer();

        return $this->dataArray;
    }

    public function valid(): bool
    {
        if (empty($this->getPartnerId())) {
            return false;
        }

        if (empty($this->getPayDataArray())) {
            return false;
        }

        return true;
    }
}