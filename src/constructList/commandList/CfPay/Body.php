<?php

namespace GERCLLC\SDK\constructList\commandList\CfPay;

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
     * @var int $color_depth
     */
    protected $color_depth;

    /**
     * @var int $screen_height
     */
    protected $screen_height;

    /**
     * @var int $screen_width
     */
    protected $screen_width;

    /**
     * @var string $user_agent
     */
    protected $user_agent;

    /**
     * @var string $user_accept
     */
    protected $user_accept;

    /**
     * @var string $card_num
     */
    protected $card_num;

    /**
     * @var string $exp
     */
    protected $exp;

    /**
     * @var string $exp_year
     */
    protected $exp_year;

    /**
     * @var int $cvv
     */
    protected $cvv;

    /**
     * @var string $email
     */
    protected $email;

    /**
     * @var string fio
     */
    protected $fio;

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
     * @return int
     */
    public function getColorDepth(): int
    {
        return $this->color_depth;
    }

    /**
     * @param int $color_depth
     * @return $this
     */
    public function setColorDepth(int $color_depth): self
    {
        $this->color_depth = $color_depth;

        return $this;
    }

    /**
     * @return int
     */
    public function getScreenHeight(): int
    {
        return $this->screen_height;
    }

    /**
     * @param int $screen_height
     * @return $this
     */
    public function setScreenHeight(int $screen_height): self
    {
        $this->screen_height = $screen_height;

        return $this;
    }

    /**
     * @return int
     */
    public function getScreenWidth(): int
    {
        return $this->screen_width;
    }

    /**
     * @param int $screen_width
     * @return $this
     */
    public function setScreenWidth(int $screen_width): self
    {
        $this->screen_width = $screen_width;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserAgent(): string
    {
        return $this->user_agent;
    }

    /**
     * @param string $user_agent
     * @return $this
     */
    public function setUserAgent(string $user_agent): self
    {
        $this->user_agent = $user_agent;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserAccept(): string
    {
        return $this->user_accept;
    }

    /**
     * @param string $user_accept
     * @return $this
     */
    public function setUserAccept(string $user_accept): self
    {
        $this->user_accept = $user_accept;

        return $this;
    }

    /**
     * @return string
     */
    public function getCardNum(): string
    {
        return $this->card_num;
    }

    /**
     * @param string $card_num
     * @return $this
     */
    public function setCardNum(string $card_num): self
    {
        $this->card_num = $card_num;

        return $this;
    }

    /**
     * @return string
     */
    public function getExp(): string
    {
        return $this->exp;
    }

    /**
     * @param string $exp
     * @return $this
     */
    public function setExp(string $exp): self
    {
        $this->exp = $exp;

        return $this;
    }

    /**
     * @return string
     */
    public function getExpYear(): string
    {
        return $this->exp_year;
    }

    /**
     * @param string $exp_year
     * @return $this
     */
    public function setExpYear(string $exp_year): self
    {
        $this->exp_year = $exp_year;

        return $this;
    }

    /**
     * @return int
     */
    public function getCvv(): int
    {
        return $this->cvv;
    }

    /**
     * @param int $cvv
     * @return $this
     */
    public function setCvv(int $cvv): self
    {
        $this->cvv = $cvv;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getFio(): string
    {
        return $this->fio;
    }

    /**
     * @param string $fio
     * @return $this
     */
    public function setFio(string $fio): self
    {
        $this->fio = $fio;

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

        if (!empty($this->getColorDepth())) {
            $this->dataArray['color_depth'] = $this->getColorDepth();
        }

        if (!empty($this->getScreenHeight())) {
            $this->dataArray['screen_height'] = $this->getScreenHeight();
        }

        if (!empty($this->getScreenWidth())) {
            $this->dataArray['screen_width'] = $this->getScreenWidth();
        }

        if (!empty($this->getUserAgent())) {
            $this->dataArray['user_agent'] = $this->getUserAgent();
        }

        if (!empty($this->getUserAccept())) {
            $this->dataArray['user_accept'] = $this->getUserAccept();
        }

        if (!empty($this->getCardNum())) {
            $this->dataArray['card_num'] = $this->getCardNum();
        }

        if (!empty($this->getExp())) {
            $this->dataArray['exp'] = $this->getExp();
        }

        if (!empty($this->getExpYear())) {
            $this->dataArray['exp_year'] = $this->getExpYear();
        }

        if (!empty($this->getCvv())) {
            $this->dataArray['cvv'] = $this->getCvv();
        }

        if (!empty($this->getEmail())) {
            $this->dataArray['email'] = $this->getEmail();
        }

        if (!empty($this->getFio())) {
            $this->dataArray['fio'] = $this->getFio();
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

        if (empty($this->getColorDepth())) {
            return false;
        }

        if (empty($this->getScreenHeight())) {
            return false;
        }

        if (empty($this->getScreenWidth())) {
            return false;
        }

        if (empty($this->getUserAgent())) {
            return false;
        }

        if (empty($this->getUserAccept())) {
            return false;
        }

        if (empty($this->getCardNum())) {
            return false;
        }

        if (empty($this->getExp())) {
            return false;
        }

        if (empty($this->getExpYear())) {
            return false;
        }

        if (empty($this->getCvv())) {
            return false;
        }

        return true;
    }
}