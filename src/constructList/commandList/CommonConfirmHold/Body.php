<?php

namespace GERCLLC\SDK\constructList\commandList\CommonConfirmHold;

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
     * Ідентифікатор платежу, який був одержаний на етапі реєстрації
     *
     * @var int $oper_id
     */
    protected $oper_id;

    /**
     * Масив даних на підтвердження
     *
     * @var array $payment_data
     */
    protected $payment_data;

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
     * @return int
     */
    public function getOperId(): int
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
     * @return array
     */
    public function getPaymentData(): array
    {
        return $this->payment_data;
    }

    /**
     * @param PaymentData $payment_data
     * @return $this
     */
    public function addPaymentData(PaymentData $payment_data): self
    {
        $this->payment_data[] = $payment_data->getArray();;

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

        if (!empty($this->getOperId())) {
            $this->dataArray['oper_id'] = $this->getOperId();
        }

        if (!empty($this->getPaymentData())) {
            $this->dataArray['payment_data'] = $this->getPaymentData();
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

        if (empty($this->getOperId())) {
            return false;
        }

        if (empty($this->getPaymentData())) {
            return false;
        }

        return true;
    }
}