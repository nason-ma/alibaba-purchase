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

class RefundApi extends Api
{
    public function getApiNS()
    {
        return 'com.alibaba.trade';
    }

    public function getRefundReasonList($orderId, array $orderEntryIds, $goodsStatus)
    {
        $params = compact('orderId', 'orderEntryIds', 'goodsStatus');

        return $this->httpPost('alibaba.trade.getRefundReasonList', $params);
    }

    public function OpQueryBatchRefundByOrderIdAndStatus($orderId, $queryType)
    {
        $params = compact('orderId', 'queryType');

        return $this->httpPost('alibaba.trade.refund.OpQueryBatchRefundByOrderIdAndStatus', $params);
    }

    public function OpQueryOrderRefund($refundId, $needTimeOutInfo = true, $needOrderRefundOperation = true)
    {
        $params = [
            'refundId' => $refundId,
            'needTimeOutInfo' => bool2str($needTimeOutInfo),
            'needOrderRefundOperation' => bool2str($needOrderRefundOperation),
        ];

        return $this->httpPost('alibaba.trade.refund.OpQueryOrderRefund', $params);
    }

    public function OpQueryOrderRefundOperationList($refundId, $pageNo, $pageSize = 50)
    {
        $params = compact('refundId', 'pageNo', 'pageSize');

        return $this->httpPost('alibaba.trade.refund.OpQueryOrderRefundOperationList', $params);
    }

    public function returnGoods($refundId, $logisticsCompanyNo, $freightBill, $description = '', $vouchers = [])
    {
        $params = compact('refundId', 'logisticsCompanyNo',
            'freightBill', 'description', 'vouchers');

        return $this->httpPost('alibaba.trade.refund.returnGoods', $params);
    }
}
