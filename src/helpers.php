<?php

function bool2str($flag)
{
    if ($flag) {
        return 'true';
    }

    return 'false';
}

function unixTime2JavaDate($time)
{
    $carbon = \Carbon\Carbon::createFromTimestamp($time, 'Asia/Shanghai');

    return $carbon->format("YmdHis000+0800");
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