# vtex api access via PHP

This library provides an objected-oriented wrapper of the PHP classes to access Vtex REST api

## Installation

```
composer required silici0/vtex:dev-master
```

## Configuration

Create a file in your root folder called "config-vtex.json" as the follow example code :
```
{
  "accountName": "account-name",
  "environment": "vtexcommercestable",
  "AppKey": "vtex-appKey",
  "AppToken": "vtex-apptoken"
}
```

## Usage example

```
require "vendor/autoload.php";
use silici0\Vtex\VtexService;

$v = new VtexService();
$params = array();
$params['orderBy'] = "orderId,desc";
$params['f_shippingEstimate'] = "2.days";
$repositories = $v->getOmsListOrders($params);

echo "Found " . count($repositories) . " results:\n";
foreach ($repositories as $repo) {
    echo $repo->orderId;
}
```
