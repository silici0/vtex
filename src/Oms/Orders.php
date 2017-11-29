<?php

namespace silici0\Vtex\Oms;

use Curl\Curl;

class Orders {
    
    private $curl;

    public function __construct()
    {
        $this->curl = new Curl();
    }

    public function getListOrders($params, $conf)
    {
        $this->curl->setHeader('accept', 'application/json');
        $this->curl->setHeader('contet-type', 'application/json');
        $this->curl->setHeader('x-vtex-api-appkey', $conf->get('AppKey'));
        $this->curl->setHeader('x-vtex-api-apptoken', $conf->get('AppToken'));
        $this->curl->get('https://'.$conf->get('accountName').'.'.$conf->get('environment').".com.br/api/oms/pvt/orders?".http_build_query($params));
        if ($this->curl->error)
            return $this->treatError();
        else
            return json_decode($this->curl->response);
    }

    public function getOrderById($ID, $conf)
    {
        $this->curl->setHeader('accept', 'application/json');
        $this->curl->setHeader('contet-type', 'application/json');
        $this->curl->setHeader('x-vtex-api-appkey', $conf->get('AppKey'));
        $this->curl->setHeader('x-vtex-api-apptoken', $conf->get('AppToken'));
        $this->curl->get('https://'.$conf->get('accountName').'.'.$conf->get('environment').".com.br/api/oms/pvt/orders/".$ID);
        if ($this->curl->error)
            return $this->treatError();
        else
            return json_decode($this->curl->response);
    }

    private function treatError()
    {
        $message = array();
        
        $message['error'] = true;
        $message['error_code'] = $this->curl->error_code;
        $message['error_message'] = $this->curl->error_message;
        return json_encode($message);
    }
}