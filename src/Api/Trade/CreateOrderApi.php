<?php


namespace Nason\AlibabaPurchase\Api\Trade;


use Nason\AlibabaPurchase\Api\Api;
use Nason\AlibabaPurchase\Exceptions\InvalidArgumentException;

class CreateOrderApi extends Api
{
    const CREATE_API_NAME = 'alibaba.trade.createOrder4CybMedia';

    const PREVIEW_API_NAME = 'alibaba.createOrder.preview4CybMedia';

    protected $options = [
        'addressParam' => [],
        'cargoParamList' => [],
        'outerOrderInfo' => [],
        'tradeType' => '',
        'useChannelPrice' => '',
        'message' => '',
    ];

    protected $addressParam = [
        'addressId' => 0,
        'fullName' => '',
        'mobile' => '',
        'phone' => '',
        'postCode' => '',
        'provinceText' => '',
        'cityText' => '',
        'areaText' => '',
        'townText' => '',
        'address' => '',
        'districtCode' => '',
    ];

    protected $cargoParam = [
        'offerId' => '',
        'quantity' => 0,
        'specId' => '',
    ];

    protected $outerOrderInfo = [
        'mediaOrderId' => '',
        'phone' => '',
        'offers' => [],
    ];

    protected $outOrderOffer = [
        'id' => '',
        'specId' => '',
        'price' => 0,
        'num' => 0,
    ];

    public function getApiNS()
    {
        return 'com.alibaba.trade';
    }

    public function createOrder4CybMedia(array $addressParam, array $cargoParamList, array $outerOrderInfo)
    {
        $this->addressParam($addressParam);
        $this->cargoParamList($cargoParamList);
        try {
            $this->outerOrderInfo($outerOrderInfo);
        } catch (InvalidArgumentException $e) {
            throw $e;
        }

        return $this->httpPost(self::CREATE_API_NAME, $this->getOptions());
    }

    public function preview4CybMedia(array $addressParam, array $cargoParamList)
    {
        $this->addressParam($addressParam);
        $this->cargoParamList($cargoParamList);
        $params = [
            'addressParam' => $this->options['addressParam'],
            'cargoParamList' => $this->options['cargoParamList'],
        ];

        return $this->httpPost(self::PREVIEW_API_NAME, $params);
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
        if (!isset($this->options[$key]) ||
            '' == $value ||
            (is_array($value) && count($value) == 0)
        ) {
            return;
        }
        $this->options[$key] = $value;
    }

    protected function addressParam(array $addressParam)
    {
        $this->addressParam = array_filter_merge($this->addressParam, $addressParam);
        $this->setOption('addressParam', $this->addressParam);

        return $this;
    }

    protected function cargoParamList(array $cargoParams)
    {
        $list = [];
        foreach ($cargoParams as $param) {
            $list[] = array_filter_merge($this->cargoParam, $param);
        }
        $this->setOption('cargoParamList', $list);

        return $this;
    }

    protected function outerOrderInfo(array $params)
    {
        if (!isset($params['offers'])) {
            throw new InvalidArgumentException('参数: offers 必须');
        }
        foreach ($params['offers'] as $key => $offers) {
            $params['offers'][$key] = array_filter_merge($this->outOrderOffer, $offers);
        }
        $this->setOption('outerOrderInfo', array_filter_merge($this->outerOrderInfo, $params));

        return $this;
    }

    public function tradeType($type)
    {
        $this->setOption('tradeType', $type);

        return $this;
    }

    public function useChannelPrice($useChannelPrice)
    {
        $this->setOption('useChannelPrice', bool2str($useChannelPrice));

        return $this;
    }

    public function message($message)
    {
        $this->setOption('message', $message);

        return $this;
    }

    protected function addressId($id)
    {
        $this->addressParam['addressId'] = $id;
        $this->setOption('addressParam', $this->addressParam);

        return $this;
    }
}