<?php

namespace GERCLLC\SDK\constructList;

use GERCLLC\SDK\abstracts\traits\Singleton;

class Config
{
    use Singleton;

    /** @var string $base_url */
    protected $base_url = '';

    /** @var int $partner_id */
    protected $partner_id;

    /** @var string $partner_key */
    protected $partner_key = '';

    /** @var int $api_ver */
    protected $api_ver = 1;

    /**
     * @return int
     */
    public function getApiVer()
    {
        return $this->api_ver;
    }

    /**
     * @param int $api_ver
     * @return $this
     */
    public function setApiVer(int $api_ver)
    {
        $this->api_ver = $api_ver;

        return $this;
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
    public function setPartnerId(int $partner_id)
    {
        $this->partner_id = $partner_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getPartnerKey(): string
    {
        return $this->partner_key;
    }

    /**
     * @param $partner_key
     * @return $this
     */
    public function setPartnerKey($partner_key)
    {
        $this->partner_key = $partner_key;

        return $this;
    }

    /**
     * @param string $baseUrl
     * @return $this
     */
    public function setBaseUri(string $baseUrl)
    {
        $this->base_url = $baseUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->base_url;
    }
}