<?php

require_once 'API.class.php';

class NewAPI extends API {

    protected $User;

    public function __construct($request, $origin) {
        parent::__construct($request);

        //PARAMETROS
        $name = $this->request['name'];

        if (!array_key_exists('apiKey', $this->request)) {
            throw new Exception('No API Key provided');
        } else if (!$this->_verifyKey($this->request['apiKey'], $origin)) {
            throw new Exception('Invalid API Key');
        } else if (!$this->_verifyIp($origin)) {
            throw new Exception('Invalid Origin');
        }

        $User->name = $name;

        $this->User = $User;
    }

    /**
     * Example of an Endpoint
     */
    protected function example() {
        if ($this->method == 'POST') {
            return "Your name is " . $this->User->name;
        } else {
            return array("message" => "Only accepts POST requests", "ok" => false);
        }
    }

    //VERIFICA A APIKEY
    private function _verifyKey($apiKey) {
        if ($apiKey == md5("temQueGerarUmaChave"))
            return true;
        else
            return false;
    }
    
    //VERIFICA O IP DE ACESSO
    private function _verifyIp($ip) {
        if ($ip == "192.168.10.1")
            return true;
        else
            return false;
    }

}

?>