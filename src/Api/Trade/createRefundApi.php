<?php


namespace Nason\AlibabaPurchase\Api\Trade;


use Nason\AlibabaPurchase\Api\Api;
use Nason\AlibabaPurchase\Exceptions\InvalidArgumentException;

class createRefundApi extends Api
{
    const API_NAME = 'alibaba.trade.createRefund';

    protected $mustOptions = [
        'orderId' => '',
        'orderEntryIds' => [],
        'disputeRequest' => '',
        'applyPayment' => '',
        'applyCarriage' => '',
        'applyReasonId' => '',
        'description' => '',
        'goodsStatus' => '',
    ];

    protected $orderEntryCount = [
        'id' => 0,
        'count' => 0
    ];

    public function getApiNS()
    {
        return 'com.alibaba.trade';
    }

    public function createRefund(array $params)
    {
        foreach ($this->mustOptions as $option => $value) {
            if (!isset($params[$option]) || empty($option[$option])) {
                throw new InvalidArgumentException("参数: {$option} 必须");
            }
        }
        $this->mustOptions = array_merge($this->mustOptions, array_filter_merge($this->mustOptions, $params));

        return $this->httpPost(self::API_NAME, $this->getOptions());
    }

    public function getOptions()
    {
        return $this->mustOptions;
    }

    public function vouchers(array $vouchers)
    {
        $this->mustOptions['vouchers'] = $vouchers;

        return $this;
    }

    public function orderEntryCountList($list)
    {
        foreach ($list as $key => $item) {
            $list[$key] = array_filter_merge($this->orderEntryCount, $item);
        }
        $this->mustOptions['orderEntryCountList'] = $list;

        return $this;
    }
}