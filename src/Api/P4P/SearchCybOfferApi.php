<?php


namespace Nason\AlibabaPurchase\Api\P4P;


use Nason\AlibabaPurchase\Api\Api;

class SearchCybOfferApi extends Api
{
    const API_NAME = 'alibaba.cps.op.searchCybOffers';

    protected $options = [
        'page' => 1,
        'pageSize' => 20,
        'biztype' => '',
        'buyerProtection' => '',
        'city' => '',
        'deliveryTimeType' => '',
        'descendOrder' => '',
        'holidayTagId' => '',
        'keyWords' => '',
        'postCategoryId' => '',
        'priceStart' => '',
        'priceEnd' => '',
        'priceFilterFields' => '',
        'province' => '',
        'sortType' => '',
        'offerTags' => '',
        'offerIds' => '',
    ];

    public function getApiNS()
    {
        return 'com.alibaba.p4p';
    }

    public function searchCybOffers($page, $pageSize = 20)
    {
        $this->setOption('page', $page);
        $this->setOption('pageSize', $pageSize);

        return $this->httpPost(self::API_NAME, $this->getOptions());
    }

    public function setOptions(array $options)
    {
        $this->options = array_filter_merge($this->options, $options);
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function setOption($key, $value)
    {
        if (!isset($this->options[$key]) || '' == $value) {
            return;
        }
        $this->options[$key] = $value;
    }

    /**
     * 经营模式; 1:生产加工,2:经销批发,3:招商代理,4:商业服务
     * @param $bizType
     * @return $this
     */
    public function bizType($bizType)
    {
        $this->setOption('biztype', $bizType);

        return $this;
    }

    /**
     * 买家保障,多个值用逗号分割;qtbh:7天包换;swtbh:15天包换
     * @param $value
     * @return $this
     */
    public function buyerProtection($value)
    {
        $this->setOption('buyerProtection', $value);

        return $this;
    }

    /**
     * 所在地区- 省
     * @param $province
     * @return $this
     */
    public function province($province)
    {
        $this->setOption('province', $province);

        return $this;
    }

    /**
     * 所在地区- 市
     * @param $city
     * @return $this
     */
    public function city($city)
    {
        $this->setOption('city', $city);

        return $this;
    }

    /**
     * 发货时间;1:24小时发货;2:48小时发货;3:72小时发货
     * @param $type
     * @return $this
     */
    public function deliveryTimeType($type)
    {
        $this->setOption('deliveryTimeType', $type);

        return $this;
    }

    /**
     * 是否倒序;正序: false;倒序:true
     * @param $isDesc
     * @return $this
     */
    public function descendOrder($isDesc)
    {
        $isDesc = bool2str($isDesc);
        $this->setOption('descendOrder', $isDesc);

        return $this;
    }

    /**
     * 商品售卖类型筛选;枚举,多个值用分号分割;免费赊账:50000114
     * @param $id
     * @return $this
     */
    public function holidayTagId($id)
    {
        $this->setOption('holidayTagId', $id);

        return $this;
    }

    /**
     * 搜索关键词
     * @param $keyWords
     * @return $this
     */
    public function keyWords($keyWords)
    {
        $this->setOption('keyWords', $keyWords);

        return $this;
    }

    /**
     * 类目id
     * @param $categoryId
     * @return $this
     */
    public function postCategoryId($categoryId)
    {
        $this->setOption('postCategoryId', $categoryId);

        return $this;
    }

    /**
     * 最低价
     * @param $price
     * @return $this
     */
    public function priceStart($price)
    {
        $this->setOption('priceStart', $price);

        return $this;
    }

    /**
     * 最高价
     * @param $price
     * @return $this
     */
    public function priceEnd($price)
    {
        $this->setOption('priceEnd', $price);

        return $this;
    }

    /**
     * 价格类型;默认分销价;agent_price:分销价;
     * @param $filter
     * @return $this
     */
    public function priceFilterFields($filter)
    {
        $this->setOption('priceFilterFields', $filter);

        return $this;
    }

    /**
     * 排序字段;normal:综合;
     * @param $type
     * @return $this
     */
    public function sortType($type)
    {
        $this->setOption('sortType', $type);

        return $this;
    }

    /**
     * 1387842:渠道专享价商品
     * @param $tag
     * @return $this
     */
    public function offerTags($tag)
    {
        $this->setOption('offerTags', $tag);

        return $this;
    }

    /**
     * 商品id搜索，多个id用逗号分割
     * @param $offerIds
     * @return $this
     */
    public function offerIds($offerIds)
    {
        if (is_array($offerIds)) {
            $offerIds = implode(',', $offerIds);
        }
        $this->setOption('offerIds', $offerIds);

        return $this;
    }
}