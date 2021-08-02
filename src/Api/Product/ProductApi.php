<?php


namespace Nason\AlibabaPurchase\Api\Product;


use Nason\AlibabaPurchase\Api\Api;

class ProductApi extends Api
{
    public function getApiNS()
    {
        return 'com.alibaba.product';
    }

    public function productInfo($offerId, $needCpsSuggestPrice = true, $needIntelligentInfo = true)
    {
        $needCpsSuggestPrice = bool2str($needCpsSuggestPrice);
        $needIntelligentInfo = bool2str($needIntelligentInfo);
        $params = compact('offerId', 'needCpsSuggestPrice', 'needIntelligentInfo');

        return $this->httpPost('alibaba.cpsMedia.productInfo', $params);
    }

    public function getCategory($categoryID)
    {
        return $this->httpPost('alibaba.category.get', compact('categoryID'));
    }

    public function follow($productId)
    {
        return $this->httpPost('alibaba.product.follow', compact('productId'));
    }

    public function unFollow($productId)
    {
        return $this->httpPost('alibaba.product.unfollow.crossborder', compact('productId'));
    }
}