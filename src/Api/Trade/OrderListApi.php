<?php

/*
 * This file is part of the nason/alibaba-purchase.
 *
 * (c) nason <mananxun99@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Nason\AlibabaPurchase\Api\Trade;

use Nason\AlibabaPurchase\Api\Api;

class OrderListApi extends Api
{
    const API_NAME = 'alibaba.trade.getBuyerOrderList';

    protected $options = [
        'bizTypes' => '',
        'createEndTime' => '',
        'createStartTime' => '',
        'isHis' => '',
        'modifyEndTime' => '',
        'modifyStartTime' => '',
        'orderStatus' => '',
        'page' => '',
        'pageSize' => '',
        'refundStatus' => '',
        'sellerMemberId' => '',
        'sellerLoginId' => '',
        'sellerRateStatus' => '',
        'tradeType' => '',
        'productName' => '',
        'needBuyerAddressAndPhone' => '',
        'needMemoInfo' => '',
    ];

    public function getApiNS()
    {
        return 'com.alibaba.trade';
    }

    public function getBuyerOrderList()
    {
        return $this->httpPost('alibaba.trade.getBuyerOrderList', $this->getOptions());
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
            (is_array($value) && 0 == count($value))
        ) {
            return;
        }
        $this->options[$key] = $value;
    }

    public function bizTypes(array $types)
    {
        $this->setOption('bizTypes', $types);

        return $this;
    }

    public function createStartTime($time)
    {
        $this->setOption('createStartTime', unixTime2JavaDate($time));

        return $this;
    }

    public function createEndTime($time)
    {
        $this->setOption('createEndTime', unixTime2JavaDate($time));

        return $this;
    }

    public function modifyStartTime($time)
    {
        $this->setOption('modifyStartTime', unixTime2JavaDate($time));

        return $this;
    }

    public function modifyEndTime($time)
    {
        $this->setOption('modifyEndTime', unixTime2JavaDate($time));

        return $this;
    }

    public function isHis($isHis)
    {
        $this->setOption('isHis', bool2str($isHis));

        return $this;
    }

    public function orderStatus($status)
    {
        $this->setOption('orderStatus', $status);

        return $this;
    }

    public function sellerMemberId($memberId)
    {
        $this->setOption('sellerMemberId', $memberId);

        return $this;
    }

    public function sellerLoginId($sellerLoginId)
    {
        $this->setOption('sellerLoginId', $sellerLoginId);

        return $this;
    }

    public function sellerRateStatus($sellerRateStatus)
    {
        $this->setOption('sellerRateStatus', $sellerRateStatus);

        return $this;
    }

    public function tradeType($tradeType)
    {
        $this->setOption('tradeType', $tradeType);

        return $this;
    }

    public function productName($productName)
    {
        $this->setOption('productName', $productName);

        return $this;
    }

    public function needBuyerAddressAndPhone($isNeed)
    {
        $this->setOption('needBuyerAddressAndPhone', bool2str($isNeed));

        return $this;
    }

    public function needMemoInfo($isNeed)
    {
        $this->setOption('needMemoInfo', bool2str($isNeed));

        return $this;
    }
}
