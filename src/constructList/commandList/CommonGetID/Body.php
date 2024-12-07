<?php

namespace GERCLLC\SDK\constructList\commandList\CommonGetID;

use Exception;
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
     * IP адреса користувача.
     * Якщо планується проводити оплату по API, цей параметр є обов'язковим!
     *
     * @var string $user_ip
     */
    protected $user_ip;

    /**
     * Тип операції 1, 2
     * За замовчуванням цей параметр має значення 1,
     * що вказує на стандартну операцію реєстрації платежу
     * 1 - Стандартна
     * 2 - Hold
     *
     * @var int $oper_type
     */
    protected $oper_type;
    const OPER_TYPE_STANDART = '1';
    const OPER_TYPE_HOLD = '2';

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

    public function __construct()
    {
        parent::__construct();

        $this->setOperType(self::OPER_TYPE_STANDART);
    }

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
     * @return string|null
     */
    public function getUserIp(): ?string
    {
        return $this->user_ip;
    }

    /**
     * @param string $user_ip
     * @return $this
     * @throws Exception
     */
    public function setUserIp(string $user_ip): self
    {
        if (!$this->validateIpAddress($user_ip)) {
            throw new Exception('IP address ' . $user_ip . ' is not valid');
        }
        $this->user_ip = $user_ip;

        return $this;
    }

    /**
     * @param string $ipAddress
     * @return bool
     */
    protected function validateIpAddress(string $ipAddress): bool
    {
        // Проверка на IPv4 или IPv6
        if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return true;
        } elseif (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return true;
        }

        return false;
    }

    /**
     * @return int
     */
    public function getOperType(): int
    {
        return $this->oper_type;
    }

    /**
     * @param int $oper_type
     * @return $this
     */
    public function setOperType(int $oper_type): self
    {
        $this->oper_type = $oper_type;

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

        if (!empty($this->getOperType())) {
            $this->dataArray['oper_type'] = $this->getOperType();
        }

        if (!empty($this->getBackrefUrl())) {
            $this->dataArray['backref_url'] = $this->getBackrefUrl();
        }

        if (!empty($this->getNotifyUrl())) {
            $this->dataArray['notify_url'] = $this->getNotifyUrl();
        }

        if (!empty($this->getUserIp())) {
            $this->dataArray['user_ip'] = $this->getUserIp();
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

        if (empty($this->getOperType())) {
            return false;
        }

        if (empty($this->getPayDataArray())) {
            return false;
        }

        return true;
    }
}