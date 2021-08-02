<?php


namespace Nason\AlibabaPurchase\Api\Trade;


use Nason\AlibabaPurchase\Api\Api;

class RefundListApi extends Api
{
    protected $options = [
        'orderId' => '',
        'applyStartTime' => '',
        'applyEndTime' => '',
        'refundStatusSet' => [],
        'sellerMemberId' => '',
        'currentPageNum' => 1,
        'pageSize' => 20,
        'logisticsNo' => '',
        'modifyStartTime' => '',
        'modifyEndTime' => '',
        'dipsuteType' => 0,
    ];

    public function getApiNS()
    {
        return 'com.alibaba.trade';
    }

    public function queryOrderRefundList()
    {
        return $this->httpPost('alibaba.trade.refund.buyer.queryOrderRefundList', $this->getOptions());
    }

    public function setOptions(array $options)
    {
        $this->options = array_filter_merge($this->options, $options);
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function setOption($key, $value)
    {
        if (!isset($this->options[$key]) ||
            '' == $value ||
            (is_array($value) && count($value) == 0)
        ) {
            return;
        }
        $this->options[$key] = $value;
    }

    public function orderId($orderId)
    {
        $this->setOption('orderId', $orderId);

        return $this;
    }

    public function refundStatusSet(array $refundStatusSet)
    {
        $this->setOption('refundStatusSet', $refundStatusSet);

        return $this;
    }

    public function sellerMemberId($sellerMemberId)
    {
        $this->setOption('sellerMemberId', $sellerMemberId);

        return $this;
    }

    public function currentPageNum($currentPageNum)
    {
        if ($currentPageNum <= 0) {
            $currentPageNum = 1;
        }
        $this->setOption('currentPageNum', $currentPageNum);

        return $this;
    }

    public function pageSize($pageSize)
    {
        $this->setOption('pageSize', $pageSize);

        return $this;
    }

    public function logisticsNo($logisticsNo)
    {
        $this->setOption('logisticsNo', $logisticsNo);

        return $this;
    }

    public function dipsuteType($dipsuteType)
    {
        if (!in_array($dipsuteType, [0, 1, 2])) {
            $dipsuteType = 0;
        }
        $this->setOption('dipsuteType', $dipsuteType);

        return $this;
    }

    public function applyStartTime($timestamp)
    {
        $this->setOption('applyStartTime', unixTime2JavaDate($timestamp));

        return $this;
    }

    public function applyEndTime($timestamp)
    {
        $this->setOption('applyEndTime', unixTime2JavaDate($timestamp));

        return $this;
    }

    public function modifyStartTime($timestamp)
    {
        $this->setOption('modifyStartTime', unixTime2JavaDate($timestamp));

        return $this;
    }

    public function modifyEndTime($timestamp)
    {
        $this->setOption('modifyEndTime', unixTime2JavaDate($timestamp));

        return $this;
    }
}