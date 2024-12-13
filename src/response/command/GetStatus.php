<?php

namespace GERCLLC\SDK\response\command;

use GERCLLC\SDK\abstracts\ResponseCommand;

class GetStatus extends ResponseCommand
{
    /**
     * @return int
     */
    public function getOperID()
    {
        return (int)$this->response['data']['oper_id'];
    }

    /**
     * @return string
     */
    public function getOrderID()
    {
        return (string)$this->response['data']['order_id'];
    }

    /**
     * @return string
     */
    public function getReceiptID()
    {
        return (string)$this->response['data']['receipt_id'];
    }

    /**
     * @return string
     */
    public function getCreateDTime()
    {
        return (string)$this->response['data']['create_dtime'];
    }

    /**
     * @return string
     */
    public function getAcquireDTime()
    {
        return (string)$this->response['data']['acquire_dtime'];
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return (string)$this->response['data']['status'];
    }

    /**
     * @return string
     */
    public function getReqAmount()
    {
        return (string)$this->response['data']['req_amount'];
    }

    /**
     * @return string
     */
    public function getReqFee()
    {
        return (string)$this->response['data']['req_fee'];
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return (string)$this->response['data']['currency'];
    }

    /**
     * @return string
     */
    public function getRrn()
    {
        return (string)$this->response['data']['rrn'];
    }

    /**
     * @return string
     */
    public function getApprovalCode()
    {
        return (string)$this->response['data']['approval_code'];
    }

    /**
     * @return string
     */
    public function getAcqTransID()
    {
        return (string)$this->response['data']['acq_trans_id'];
    }

    /**
     * @return string
     */
    public function getToolName()
    {
        return (string)$this->response['data']['tool_name'];
    }

    /**
     * @return string
     */
    public function getPartnerData()
    {
        return (string)$this->response['data']['partner_data'];
    }

    /**
     * @return int
     */
    public function getPaymentTool()
    {
        return (int)$this->response['data']['payment_tool'];
    }

    /**
     * @return string
     */
    public function getMerchantLabel()
    {
        return (string)$this->response['data']['merchant_label'];
    }

    public function getTerminalLabel()
    {
        return (string)$this->response['data']['terminal_label'];
    }

    /**
     * @return int
     */
    public function getAcqID()
    {
        return (int)$this->response['data']['acq_id'];
    }

    /**
     * @return string
     */
    public function getAcqAlias()
    {
        return (string)$this->response['data']['acq_alias'];
    }

    /**
     * @return int
     */
    public function getIssuerID()
    {
        return (int)$this->response['data']['issuer_id'];
    }

    /**
     * @return string
     */
    public function getIssuerAlias()
    {
        return (string)$this->response['data']['issuer_alias'];
    }

    /**
     * @return int
     */
    public function getCardType()
    {
        return (int)$this->response['data']['card_type'];
    }

    /**
     * @return int
     */
    public function getTypeName()
    {
        return (string)$this->response['data']['type_name'];
    }

    /**
     * @return string
     */
    public function getCardNetwork()
    {
        return (string)$this->response['data']['card_network'];
    }

    /**
     * @return array
     */
    public function getPointsData()
    {
        return (array)$this->response['data']['points_data'];
    }

    /**
     * @return array
     */
    public function getRefundData()
    {
        return (array)$this->response['data']['refund_data'];
    }
}