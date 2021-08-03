<?php

/*
 * This file is part of the nason/alibaba-purchase.
 *
 * (c) nason <mananxun99@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Nason\AlibabaPurchase\Api\P4P;

use Nason\AlibabaPurchase\Api\Api;

class MediaUserApi extends Api
{
    protected $behaviour = [
        'uuid' => '',
        'actionTime' => '',
        'actionType' => '',
        'feedType' => '',
        'deviceIdMd5' => '',
        'phoneMd5' => '',
        'actionDetail' => '',
        'feedId' => '',
        'feedTitle' => '',
        'feedPrice' => '',
        'feedCategory' => '',
    ];

    public function getApiNS()
    {
        return 'com.alibaba.p4p';
    }

    public function saveMediaUserBehaviour($uuid, $actionType, $feedType, $actionTime = 0)
    {
        if (!$actionTime) {
            $actionTime = timestamp_ms();
        }
        $this->setBehaviour('uuid', $uuid);
        $this->setBehaviour('actionType', $actionType);
        $this->setBehaviour('feedType', $feedType);
        $this->setBehaviour('actionTime', $actionTime);

        return $this->httpPost('alibaba.cps.op.saveMediaUserBehaviour', $this->getBehaviour());
    }

    public function mediaUserRecommendOfferService($pageNo, $pageSize = 20, $deviceIdMd5 = '', $phoneMd5 = '')
    {
        $params = compact('pageNo', 'pageSize', 'deviceIdMd5', 'phoneMd5');

        return $this->httpPost('alibaba.cps.op.mediaUserRecommendOfferService', $params);
    }

    public function setBehaviours(array $behaviours)
    {
        $this->behaviour = array_filter_merge($this->behaviour, $behaviours);
    }

    public function setBehaviour($key, $value)
    {
        if (!isset($this->behaviour[$key]) ||
            '' == $value ||
            is_array($value)
        ) {
            return;
        }

        $this->behaviour[$key] = $value;
    }

    public function getBehaviour()
    {
        return $this->behaviour;
    }

    public function deviceIdMd5($md5)
    {
        $this->setBehaviour('deviceIdMd5', $md5);

        return $this;
    }

    public function phoneMd5($md5)
    {
        $this->setBehaviour('phoneMd5', $md5);

        return $this;
    }

    public function actionDetail($detail)
    {
        $this->setBehaviour('actionDetail', $detail);

        return $this;
    }

    public function feedId($feedId)
    {
        $this->setBehaviour('feedId', $feedId);

        return $this;
    }

    public function feedTitle($feedTitle)
    {
        $this->setBehaviour('feedTitle', $feedTitle);

        return $this;
    }

    public function feedPrice($feedPrice)
    {
        $this->setBehaviour('feedPrice', $feedPrice);

        return $this;
    }

    public function feedCategory($feedCategory)
    {
        $this->setBehaviour('feedCategory', $feedCategory);

        return $this;
    }
}
