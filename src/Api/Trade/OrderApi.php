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
use Nason\AlibabaPurchase\Exceptions\InvalidArgumentException;

class OrderApi extends Api
{
    public function getApiNS()
    {
        return 'com.alibaba.trade';
    }

    public function buyerView($orderId, $webSite = '1688', $includeFields = '')
    {
        $params = compact('orderId', 'webSite', 'includeFields');

        return $this->httpPost('alibaba.trade.get.buyerView', $params);
    }

    public function parseAddressCode($addressInfo)
    {
        return $this->httpPost('alibaba.trade.addresscode.parse', compact('addressInfo'));
    }

    public function getAddressCode($areaCode, $webSite = '1688')
    {
        $params = compact('areaCode', 'webSite');

        return $this->httpPost('alibaba.trade.addresscode.get', $params);
    }

    public function getAddressCodeChild($areaCode = '', $webSite = '1688')
    {
        $params = compact('areaCode', 'webSite');

        return $this->httpPost('alibaba.trade.addresscode.getchild', $params);
    }

    public function cancelOrder($tradeID, $cancelReason, $webSite = '1688', $remark = '')
    {
        $params = compact('tradeID', 'cancelReason', 'webSite', 'remark');

        return $this->httpPost('alibaba.trade.cancel', $params);
    }

    public function getAlipayUrl(array $orderIdList)
    {
        if (empty($orderIdList) || count($orderIdList) > 30) {
            throw new InvalidArgumentException('参数: orderIdList 必须且最多支持30个订单');
        }
        $orderIdList = compact('orderIdList');

        return $this->httpPost('alibaba.alipay.url.get', $orderIdList);
    }

    public function protocolPay($orderId)
    {
        return $this->httpPost('alibaba.trade.pay.protocolPay', compact('orderId'));
    }
}
