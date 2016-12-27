<?php
include_once 'curl.php';

class API {
    protected $api;

    protected $curl;

    protected $data;

    protected $api_key;

    protected $config;

    public function __construct($url = '/', $data)
    {
        $this->Load();
        $this->curl = new CURL();
        $this->api  = 'https://www.virustotal.com/vtapi/v2';
        $this->api_key = $this->config['api_key'];

        $data += [ 'apikey'  => $this->api_key ];
        $this->curl->setUrl($this->api . $url);
        $this->curl->setData($data);

        $this->curl->initialize();
    }

    public function outputJSON() {
        header("Access-Control-Allow-Origin: *");
        header('Content-type:application/json;charset=utf-8');
        echo $this->curl->getResult();
    }

    public function getResult()
    {
        return $this->curl->getResult();
    }

    private function Load()
    {
        $path = dirname(__FILE__) . '/.config';
        if (file_exists($path)) {
            $this->config = parse_ini_file($path);
        } else {
            throw new \Exception('Cannot read config file');
        }
    }
}
