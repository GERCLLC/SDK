<?php

namespace GERCLLC\SDK\constructList\commandList\TokenPay;

use GERCLLC\SDK\abstracts\AbstractCommand;

class Body extends AbstractCommand
{
    /**
     * Ідентифікатор партнера
     *
     * @var int $partner_id
     */
    protected $partner_id;

    /**
     * Ідентифікатор операції
     *
     * @var int $oper_id
     */
    protected $oper_id;

    /**
     * Токен картки, який ви отримала у відповіді операциі "Перевірка картки"
     *
     * @var string $card_token
     */
    protected $card_token;

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
     * @return string
     */
    public function getCardToken(): string
    {
        return $this->card_token;
    }

    /**
     * @param string $card_token
     * @return $this
     */
    public function setCardToken(string $card_token): self
    {
        $this->card_token = $card_token;

        return $this;
    }

    public function getArray(): array
    {
        if (!empty($this->getPartnerId())) {
            $this->dataArray['partner_id'] = $this->getPartnerId();
        }

        if (!empty($this->getOperId())) {
            $this->dataArray['oper_id'] = $this->getOperId();
        }

        if (!empty($this->getCardToken())) {
            $this->dataArray['card_token'] = $this->getCardToken();
        }

        return $this->dataArray;
    }

    public function valid(): bool
    {
        if (empty($this->getPartnerId())) {
            return false;
        }

        if (empty($this->getOperId())) {
            return false;
        }

        if (empty($this->getCardToken())) {
            return false;
        }

        return true;
    }
}