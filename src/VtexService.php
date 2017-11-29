<?php namespace silici0\Vtex;

use Noodlehaus\Config;
use silici0\Vtex\Oms\Orders;
use silici0\Vtex\MasterData\DataEntities;

class VtexService{

    private $config;
    private $oms;
    private $masterData;
    
    public function __construct()
    {
        $this->config = Config::load('config-vtex.json');
    }

    /**
     * https://documenter.getpostman.com/view/487146/oms/6tjSKqi#209cb0dd-4877-4db8-a372-95173f49be07
     * 
     * @param  array $params array('orderBy' => 'creationDate,desc', 'page' => '3')
     * @return Object        [Object from json decode vtex response]
     */
    public function getOmsListOrders($params)
    {
        $this->oms = new Orders();
        return $this->oms->getListOrders($params, $this->config);
    }

    /**
     * https://documenter.getpostman.com/view/487146/oms/6tjSKqi#43524211-bbed-4f80-9a9b-d96b32347f0a
     * 
     * @param  string $id example: "v544226pdvn-01"
     * @return Object     [Object from json decode vtex response]
     */
    public function getOmsOrderById($id)
    {
        $this->oms = new Orders();
        return $this->oms->getOrderById($id, $this->config);
    }

    /**
     * https://documenter.getpostman.com/view/164907/masterdata-api-v102/2TqWsD#1df0dfd0-8859-4fe5-a77f-87c4bf35aa8c
     *
     * @return Object [Object from json decode vtex response]
     */
    public function getMasterDataListEntities()
    {
        $this->masterData = new DataEntities();
        return $this->masterData->getListDataEntities($this->config);
    }

    public function getMasterDataClientById()
    {
        $this->masterData = new DataEntities();
        return $this->masterData->getClientDatafromEntityById('', $this->config);
    }
}