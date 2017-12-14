<?php

namespace silici0\Vtex\MasterData;

use Curl\Curl;

class DataEntities {
    
    private $curl;

    public function __construct()
    {
        $this->curl = new Curl();
    }

    public function getListDataEntities($conf)
    {
        $this->curl->setHeader('accept', 'application/vnd.vtex.ds.v10+json');
        $this->curl->setHeader('contet-type', 'application/json');
        $this->curl->setHeader('x-vtex-api-appkey', $conf->get('AppKey'));
        $this->curl->setHeader('x-vtex-api-apptoken', $conf->get('AppToken'));
        $this->curl->get('http://api.vtex.com/'.$conf->get('accountName').'/dataentities');
        if ($this->curl->error)
            return $this->treatError();
        else
            return json_decode($this->curl->response);
    }

    public function getClientDatafromEntityById($id, $conf)
    {
        $this->curl->setHeader('accept', 'application/vnd.vtex.ds.v10+json');
        $this->curl->setHeader('contet-type', 'application/json');
        $this->curl->setHeader('x-vtex-api-appkey', $conf->get('AppKey'));
        $this->curl->setHeader('x-vtex-api-apptoken', $conf->get('AppToken'));
        $this->curl->get('http://api.vtex.com/'.$conf->get('accountName').'/dataentities/CL/search?_fields=_all&_where=userId='.$id);
        if ($this->curl->error)
            return $this->treatError();
        else
            return json_decode($this->curl->response);
    }

    public function getClientDatafromEntityByEmail($email, $conf)
    {
        $this->curl->setHeader('accept', 'application/vnd.vtex.ds.v10+json');
        $this->curl->setHeader('contet-type', 'application/json');
        $this->curl->setHeader('x-vtex-api-appkey', $conf->get('AppKey'));
        $this->curl->setHeader('x-vtex-api-apptoken', $conf->get('AppToken'));
        $this->curl->get('http://api.vtex.com/'.$conf->get('accountName').'/dataentities/CL/search?_fields=_all&_where=email='.$email);
        if ($this->curl->error)
            return $this->treatError();
        else
            return json_decode($this->curl->response);
    }
}