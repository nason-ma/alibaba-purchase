<?php

/*
 * This file is part of the nason/alibaba-purchase.
 *
 * (c) nason <mananxun99@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

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
            $appKey,
        ];

        return implode('/', $factors);
    }

    public static function argsSignFactor(array $args)
    {
        ksort($args);
        $factor = '';
        foreach ($args as $key => $arg) {
            $factor .= $key.$arg;
        }

        return $factor;
    }

    public static function signature($apiNS, $apiName, $appKey, $secretKey, array $args)
    {
        $factor = self::uriSignFactor($apiNS, $apiName, $appKey).self::argsSignFactor($args);

        return strtoupper(hash_hmac('sha1', $factor, $secretKey));
    }
}
