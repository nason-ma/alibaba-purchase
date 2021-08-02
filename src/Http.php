<?php

/*
 * This file is part of the nason/gw_supply_chain.
 *
 * (c) nason <mananxun99@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Nason\AlibabaPurchase;

use GuzzleHttp\Client;
use Nason\AlibabaPurchase\Exceptions\HttpException;

class Http
{
    protected static $guzzleOptions = [];

    public static function getHttpClient()
    {
        return new Client(self::$guzzleOptions);
    }

    public static function setGuzzleOptions(array $options)
    {
        self::$guzzleOptions = $options;
    }

    public static function setGuzzleOption($key, $value)
    {
        if ($value == '') {
            return;
        }
        self::$guzzleOptions[$key] = $value;
    }

    public static function post($appKey, $apiNS, $apiName, array $options = [])
    {
        self::setGuzzleOption('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        self::setGuzzleOption('base_uri', Config::baseUri());

        $uri = Config::uri($apiNS, $apiName, $appKey);
        try {
            $response = self::getHttpClient()
                ->post($uri, ['query' => http_build_query($options)])
                ->getBody()
                ->getContents();

            return json_decode($response, true);
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
