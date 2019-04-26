<?php namespace silici0\Vtex;

use Noodlehaus\Config;
use silici0\Vtex\Oms\Orders;
use silici0\Vtex\Oms\OrdersList;
use silici0\Vtex\MasterData\DataEntities;

class VtexService{

    private $config;
    private $oms;
    private $masterData;
    
    public function __construct($path = null)
    {
        if (!is_null($path))
            $this->config = Config::load($path.'config-vtex.json');
        else
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
        return new OrdersList($params, $this->config);
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

    /**
     * https://documenter.getpostman.com/view/164907/masterdata-api-v102/2TqWsD#9a2a98aa-1041-4fe9-ab8c-2f80177e5bde
     *
     * @return Object [Object from json decode vtex response]
     */
    public function getMasterDataEntityStructure($acronym)
    {
        $this->masterData = new DataEntities();
        return $this->masterData->getDataEntityStructure($this->config, $acronym);
    }

    /**
     * https://documenter.getpostman.com/view/164907/masterdata-api-v102/2TqWsD#1df0dfd0-8859-4fe5-a77f-87c4bf35aa8c
     *
     * @param  string $id example: "539a912d-9e4b-442c-a9f3-5d1a0525h92a"
     * @return Object [Object from json decode vtex response]
     */
    public function getMasterDataClientById($id)
    {
        $this->masterData = new DataEntities();
        return $this->masterData->getClientDatafromEntityById($id, $this->config);
    }

    /**
     * https://documenter.getpostman.com/view/164907/masterdata-api-v102/2TqWsD#1df0dfd0-8859-4fe5-a77f-87c4bf35aa8c
     *
     * @param  string $id example: "email@email.com"
     * @return Object [Object from json decode vtex response]
     */
    public function getMasterDataClientByEmail($email)
    {
        $this->masterData = new DataEntities();
        return $this->masterData->getClientDatafromEntityByEmail($email, $this->config);
    }


}