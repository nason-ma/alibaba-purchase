<?php


namespace Nason\AlibabaPurchase\Api\P4P;


use Nason\AlibabaPurchase\Api\Api;

class P4PApi extends Api
{
    public function getApiNS()
    {
        return 'com.alibaba.p4p';
    }

    public function listPriceRadarOffer(array $offerIds)
    {
        return $this->httpPost('alibaba.cps.listPriceRadarOffer', compact('offerIds'));
    }

    public function queryOfferDetailActivity($offerId)
    {
        return $this->httpPost('alibaba.cps.queryOfferDetailActivity', compact('offerId'));
    }

    public function listCybUserGroupFeed($pageNo, $pageSize = 20, $groupId = 0, $feedId = 0, $title = '')
    {
        $params = compact('pageNo', 'pageSize', 'groupId', 'feedId', 'title');

        return $this->httpPost('alibaba.cps.op.listCybUserGroupFeed', $params);
    }

    public function listCybUserGroup($pageNo, $pageSize = 20)
    {
        $params = compact('pageNo', 'pageSize');

        return $this->httpPost('alibaba.cps.op.listCybUserGroup', $params);
    }
}