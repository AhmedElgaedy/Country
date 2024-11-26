<?php


namespace App\Services;


class SoapService {
    protected $client;


    public function __construct()
    {
        $this->client = new \SoapClient('http://example.com/service?wsdl');
    }

    public function call($method, $params)
    {
        return $this->client->__soapCall($method, $params);
    }
}
