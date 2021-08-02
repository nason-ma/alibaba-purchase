<?php

/*
 * This file is part of the nason/alibaba-purchase.
 *
 * (c) nason <mananxun99@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Nason\AlibabaPurchase\Api\Logistics;

use Nason\AlibabaPurchase\Api\Api;

class LogisticsApi extends Api
{
    public function getApiNS()
    {
        return 'com.alibaba.logistics';
    }

    public function getLogisticsInfos($orderId, $webSite = '1688', $fields = '')
    {
        $params = compact('orderId', 'webSite', 'fields');

        return $this->httpPost('alibaba.trade.getLogisticsInfos.buyerView', $params);
    }

    public function getLogisticsTraceInfo($orderId, $webSite = '1688', $logisticsId = '')
    {
        $params = compact('orderId', 'webSite', 'logisticsId');

        return $this->httpPost('alibaba.trade.getLogisticsTraceInfo.buyerView', $params);
    }

    public function OpQueryLogisticCompanyList()
    {
        return $this->httpPost('alibaba.logistics.OpQueryLogisticCompanyList');
    }

    public function OpQueryLogisticCompanyListOffline()
    {
        return $this->httpPost('alibaba.logistics.OpQueryLogisticCompanyList.offline');
    }
}
