<?php

/**
 * Created by PhpStorm.
 * User: raul4916
 * Date: 2/14/16
 * Time: 11:35 AM
 */
namespace AppBundle\Error;
use Symfony\Component\Config\Definition\Exception\Exception;

class JSONException extends Exception
{
    function __constructor($message = null, $code = 0, Exception $previous = null){
        parent::__construct($message,$code,$previous);
    }
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
