<?php

/*
 * This file is part of the nason/alibaba-purchase.
 *
 * (c) nason <mananxun99@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Carbon\Carbon;
use Nason\AlibabaPurchase\Config;

function bool2str($flag)
{
    if ($flag) {
        return 'true';
    }

    return 'false';
}

function unixTime2JavaDate($time)
{
    $carbon = Carbon::createFromTimestamp($time, Config::TIME_ZONE);

    return $carbon->format('YmdHis000+0800');
}

function array_filter_merge(array $array1, array $array2)
{
    $result = [];
    foreach ($array1 as $key => $item) {
        if (isset($array2[$key]) && !empty($array2[$key])) {
            $result[$key] = $array2[$key];
        } else {
            $result[$key] = $item;
        }
    }

    return array_filter($result);
}

function timestamp_ms()
{
    $time = Carbon::now()->setTimezone(Config::TIME_ZONE);

    return (int)sprintf('%.0f', $time->timestamp . ($time->micro / 1000));
}
