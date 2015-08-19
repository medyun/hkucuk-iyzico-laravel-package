<?php namespace Hkucuk\Iyzico;

use Illuminate\Support\Facades\Config;

/**
 * Created by PhpStorm.
 * User: hkucuk
 * Date: 17.08.2015
 * Time: 18:29
 */

class Iyzico{

    private $api_id;
    private $secret;

    public function __construct(){

        $this->api_id = Config::get('iyzico::api_id');
        $this->secret = Config::get('iyzico::secret');
    }

    public function getForm($datas){

        $url = "https://api.iyzico.com/v2/create";

        $data = "api_id=".$this->api_id."&secret=".$this->secret;

        if(empty($datas))
            throw new Exception("Problem: Parameters array is empty!");

        foreach($datas as $key => $value){
            $data .= "&".$key."=".$value;
        }

        $params = array('http' => array(
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => $data
        ));

        return $this->connection($url, $params);
    }

    public function connection($url, $params){

        $ctx = stream_context_create($params);
        $fp = @fopen($url, 'rb', false, $ctx);
        if (!$fp) {
            throw new Exception("Problem with $url, $php_errormsg");
        }

        $response = @stream_get_contents($fp);
        if ($response === false) {
            throw new Exception("problem reading data from $url, $php_errormsg");
        }

        return json_decode($response);
    }

}