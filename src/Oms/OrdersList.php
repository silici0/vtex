<?php  namespace silici0\Vtex\Oms;

use Elliotchance\Iterator\AbstractPagedIterator;
use Curl\Curl;

class OrdersList extends AbstractPagedIterator
{
    protected $totalSize = 0;
    protected $searchTerms;

    public function __construct($searchTerms)
    {
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
        $this->curl->setHeader('x-vtex-api-appkey', $conf->get('AppKey'));
        $this->curl->setHeader('x-vtex-api-apptoken', $conf->get('AppToken'));
        $this->searchTerms['page'] = $pageNumber+1;
        $this->searchTerms['per_page'] = $this->getPageSize();
        $this->curl->get('https://'.$conf->get('accountName').'.'.$conf->get('environment').".com.br/api/oms/pvt/orders?".http_build_query($this->searchTerms));
        if ($this->curl->error)
            return $this->treatError();
        else {
            $result = json_decode($this->curl->response);
            return $result->list;
        }

        $url = "https://api.github.com/search/repositories?" . http_build_query([
            'q' => $this->searchTerm,
            'page' => $pageNumber + 1,
        ]);
        $result = json_decode(file_get_contents($url), true);
        $this->totalSize = $result['total_count'];
        return $result['items'];
    }
}
