<?php namespace silici0\Vtex;

use Noodlehaus\Config;
use silici0\Vtex\Oms\Orders;

class VtexService{

    private $config;
    private $oms;
    
    public function __construct()
    {
        $this->config = Config::load('config.json');
    }


    public function getOmsListOrders($params)
    {
        $this->oms = new Orders();
        return $this->oms->getListOrders($params, $this->config);
    }
}