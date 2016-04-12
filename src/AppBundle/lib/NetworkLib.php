<?php
/**
 * Created by PhpStorm.
 * User: raul
 * Date: 2/21/16
 * Time: 7:14 PM
 */
namespace AppBundle\lib;

use Symfony\Component\HttpFoundation\AcceptHeader;
class NetworkLib{

    static function requestServer($url = DefinitionLib::MAIN_URL,$accept = "application/json",$reqType = "GET"){


        $ch= curl_init($url);
        AcceptHeader::fromString("html/text");

        curl_setopt($ch,CURLOPT_PORT,8000);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,$reqType);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 8000);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);

        if(!($result = curl_exec($ch))){
            $result =  curl_error($ch) . curl_errno($ch);
        }

        curl_close($ch);

        return $result;

    }

}