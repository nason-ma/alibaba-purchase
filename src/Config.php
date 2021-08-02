<?php


namespace Nason\AlibabaPurchase;


class Config
{
    const BASE_URI = 'https://gw.open.1688.com/openapi';

    const PROTOCOL = 'param2';

    const API_VERSION = 1;

    public static function baseUri()
    {
        $uris = [
            self::BASE_URI,
            self::PROTOCOL,
            self::API_VERSION,
        ];
        return implode('/', $uris) . '/';
    }

    public static function uri($apiNS, $apiName, $appKey)
    {
        return $apiNS . '/' . $apiName . '/' . $appKey;
    }

    public static function fullUri($appKey, $apiNS, $apiName)
    {
        return self::baseUri() . '/' . self::uri($apiNS, $apiName, $appKey);
    }
}