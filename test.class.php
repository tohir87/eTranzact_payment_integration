<?php

/**
 * Description of test
 *
 * @author tohir <otcleantech@gmail.com>
 */
class Test {
    
    private $baseUrl;
    private $client;
    
    
    public function __construct() {
        $this->baseUrl = "http://demo.etranzact.com/FundGateWSDL/doc.wsdl";
        try{
            $this->client = new SoapClient($this->baseUrl, ['proxy' => null]);
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
        
    }
    
    
    const ETRANZACT_SECRET_KEY = "KEd4gDNSDdMBxCGliZaC8w";

    //put your code here

    public static function encryptPinCode($pin = "0012") {
        $master_key = substr(self::ETRANZACT_SECRET_KEY, 0, 16);
        $pin = pkcs5_pad($pin, 16);

        $cipher = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
        mcrypt_generic_init($cipher, $master_key, $master_key);
        $encrypted = mcrypt_generic($cipher, $pin);

        return base64_encode($encrypted);
    }
    
    public function processRequest($data) {
        $data = json_decode(json_encode($data), TRUE);
        return $this->client->process($data);
    }

}
