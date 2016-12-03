<?php
class CURL {
    protected $curl;
    protected $data;
    protected $url;

    public function __construct()
    {
        $this->curl = curl_init();
    }

    public function initialize()
    {
        curl_setopt($this->curl, CURLOPT_URL, $this->url);
        curl_setopt($this->curl, CURLOPT_POST, True);
        curl_setopt($this->curl, CURLOPT_VERBOSE, 1); // remove this if your not debugging
        curl_setopt($this->curl, CURLOPT_ENCODING, 'gzip,deflate'); // please compress data
        curl_setopt($this->curl, CURLOPT_USERAGENT, "gzip, SafEye");
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER ,True);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $this->data);
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getResult()
    {
        $result = curl_exec($this->curl);

        if ($this->getStatusCode() == 200) { // OK
            return $result;
        } else {  // Error occured
            return null;
        }
    }

    private function getStatusCode()
    {
        return curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
    }

    public function __desctruct()
    {
        curl_close($this->curl);
    }
}
