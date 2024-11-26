<?php

namespace GERCLLC\SDK;

class Signature
{
    protected $partner_id = '';
    protected $partner_key = '';

    protected $text = '';

    /**
     * @param $partner_id
     * @param $partner_key
     * @throws \Exception
     */
    public function __construct($partner_id, $partner_key)
    {
        if (!is_string($partner_id)) {
            throw new \Exception(__FILE__ . ' line ' . __LINE__ . '. Must be of the type string given');
        }

        if (!is_string($partner_key)) {
            throw new \Exception(__FILE__ . ' line ' . __LINE__ . '. Must be of the type string given');
        }

        $this->partner_id = $partner_id;
        $this->partner_key = $partner_key;
    }

    /**
     * @param $text
     * @return string
     * @throws \Exception
     */
    public function setText($text)
    {
        if (!is_string($text)) {
            throw new \Exception(__FILE__ . ' line ' . __LINE__ . '. Must be of the type string given');
        }

        $this->text = $text;

        return $text;
    }

    protected function removeWhitespaceAndNewlines(string $text)
    {
        // Декодируем JSON в массив
        $data = json_decode($text, true);

        // Кодируем обратно в JSON
        return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getBodyWithSignature()
    {
        if (empty($this->text)) {
            throw new \Exception(__FILE__ . ' line ' . __LINE__ . '. Text variable is empty');
        }

        $data = $this->removeWhitespaceAndNewlines($this->text);

        return sha1(sha1($data) . sha1($this->partner_id . $this->partner_key));
    }
}