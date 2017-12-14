<?php  namespace silici0\Vtex\Oms;

use Elliotchance\Iterator\AbstractPagedIterator;
use Curl\Curl;

class OrdersList extends AbstractPagedIterator
{
    protected $totalSize =0;
    protected $searchTerms;
    private $curl;
    private $conf;

    public function __construct($searchTerms, $conf)
    {
        $this->conf = $conf;
        $this->curl = new Curl();
        $this->searchTerms = $searchTerms;
        $this->getPage(0); 
    }

    public function getTotalSize()
    {
        return $this->totalSize;
    }

    public function getPageSize()
    {
        return 100;
    }

    public function getPage($pageNumber)
    {
        $this->curl->setHeader('accept', 'application/json');
        $this->curl->setHeader('contet-type', 'application/json');
        $this->curl->setHeader('x-vtex-api-appkey', $this->conf->get('AppKey'));
        $this->curl->setHeader('x-vtex-api-apptoken', $this->conf->get('AppToken'));
        $this->searchTerms['page'] = $pageNumber+1;
        $this->searchTerms['per_page'] = $this->getPageSize();
        $this->curl->get('https://'.$this->conf->get('accountName').'.'.$this->conf->get('environment').".com.br/api/oms/pvt/orders?".http_build_query($this->searchTerms));
        if ($this->curl->error)
            return $this->treatError();
        else {
            $result = json_decode($this->curl->response, true);
            $this->totalSize = $result->paging->total;
            return $result->list;
        }
    }
}
