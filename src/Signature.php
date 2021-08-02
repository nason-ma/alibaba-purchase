<?php


namespace Nason\AlibabaPurchase;


class Signature
{
    public static function uriSignFactor($apiNS, $apiName, $appKey)
    {
        $factors = [
            Config::PROTOCOL,
            Config::API_VERSION,
            $apiNS,
            $apiName,
            $appKey
        ];
        return implode('/', $factors);
    }

    public static function argsSignFactor(array $args)
    {
        ksort($args);
        $factor = '';
        foreach ($args as $key => $arg) {
            $factor .= $key . $arg;
        }
        return $factor;
    }

    public static function signature($apiNS, $apiName, $appKey, $secretKey, array $args)
    {
        $factor = self::uriSignFactor($apiNS, $apiName, $appKey) . self::argsSignFactor($args);

        return strtoupper(hash_hmac("sha1", $factor, $secretKey));
    }
}