<?php

/*
 * This file is part of the nason/alibaba-purchase.
 *
 * (c) nason <mananxun99@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Nason\AlibabaPurchase\Api;

use Carbon\Carbon;
use Nason\AlibabaPurchase\Http;
use Nason\AlibabaPurchase\Signature;

abstract class Api
{
    protected $appKey;

    protected $secretKey;

    protected $accessToken;

    protected $params = [];

    public function __construct($appKey, $secretKey, $accessToken)
    {
        $this->appKey = $appKey;
        $this->secretKey = $secretKey;
        $this->accessToken = $accessToken;
        $this->initParams();
    }

    protected function initParams()
    {
        $this->params = [
            '_aop_timestamp' => Carbon::now()->getTimestampMs(),
            'access_token' => $this->accessToken,
        ];
    }

    protected function fullParams($apiName, array $params)
    {
        $params = array_merge($this->params, $params);
        $params['_aop_signature'] = Signature::signature(
            $this->getApiNS(),
            $apiName,
            $this->appKey,
            $this->secretKey,
            $params
        );

        return $params;
    }

    protected function httpPost($apiName, array $params = [])
    {
        $params = array_filter($params);
        foreach ($params as $key => $param) {
            if (is_array($param)) {
                $params[$key] = json_encode($param);
            }
            if (is_bool($param)) {
                $params[$key] = bool2str($param);
            }
        }

        return Http::post(
            $this->appKey,
            $this->getApiNS(),
            $apiName,
            $this->fullParams($apiName, $params)
        );
    }

    abstract public function getApiNS();
}
