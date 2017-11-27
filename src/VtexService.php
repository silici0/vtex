<?php namespace silici0\vtex;

use Noodlehaus\Config;

class VtexService{

    private $config;
    
    public function __construct()
    {
        $this->config = Config::load('config.json');
    }
}