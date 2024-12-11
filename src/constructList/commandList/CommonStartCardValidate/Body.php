<?php

namespace GERCLLC\SDK\constructList\commandList\CommonStartCardValidate;

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
     * Валюта платежу
     *
     * @var string $currency
     */
    protected $currency;

    /**
     * Мова інтерфейсу та повідомлень
     *
     * @var string $lang
     */
    protected $lang;

    /**
     * Час життя платежу (у секундах)
     *
     * @var int $lifetime
     */
    protected $lifetime;

    /**
     * ID користувача у системі партнера
     *
     * @var int $user_id
     */
    protected $user_id;

    /**
     * Номер телефону користувача
     *
     * @var int $user_phone
     */
    protected $user_phone;

    /**
     * E-mail користувача
     *
     * @var string $user_email
     */
    protected $user_email;

    /**
     * Ім'я користувача в системі партнера
     *
     * @var string $user_name
     */
    protected $user_name;

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
     * @return PayData[]|array
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
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return $this
     */
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLang(): ?string
    {
        return $this->lang;
    }

    /**
     * @param string $lang
     * @return $this
     */
    public function setLang(string $lang): self
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getLifetime(): ?int
    {
        return $this->lifetime;
    }

    /**
     * @param int $lifetime
     * @return $this
     */
    public function setLifetime(int $lifetime): self
    {
        $this->lifetime = $lifetime;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     * @return $this
     */
    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getUserPhone(): ?int
    {
        return $this->user_phone;
    }

    /**
     * @param int $user_phone
     * @return $this
     */
    public function setUserPhone(int $user_phone): self
    {
        $this->user_phone = $user_phone;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUserEmail(): ?string
    {
        return $this->user_email;
    }

    /**
     * @param string $user_email
     * @return $this
     */
    public function setUserEmail(string $user_email): self
    {
        $this->user_email = $user_email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUserName(): ?string
    {
        return $this->user_name;
    }

    /**
     * @param string $user_name
     * @return $this
     */
    public function setUserName(string $user_name): self
    {
        $this->user_name = $user_name;

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

        if (!empty($this->getUserIp())) {
            $this->dataArray['user_ip'] = $this->getUserIp();
        }

        if (!empty($this->getPayDataArray())) {
            $this->dataArray['paydata'] = $this->getPayDataArray();
        }

        $this->dataArray['api_ver'] = Config::getInstance()->getApiVer();

        if (!empty($this->getCurrency())) {
            $this->dataArray['currency'] = $this->getCurrency();
        }

        if (!empty($this->getLang())) {
            $this->dataArray['lang'] = $this->getLang();
        }

        if (!empty($this->getLifetime())) {
            $this->dataArray['lifetime'] = $this->getLifetime();
        }

        if (!empty($this->getUserId())) {
            $this->dataArray['user_id'] = $this->getUserId();
        }

        if (!empty($this->getUserPhone())) {
            $this->dataArray['user_phone'] = $this->getUserPhone();
        }

        if (!empty($this->getUserEmail())) {
            $this->dataArray['user_email'] = $this->getUserEmail();
        }

        if (!empty($this->getUserName())) {
            $this->dataArray['user_name'] = $this->getUserName();
        }

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