<?php
/**
 * Created by PhpStorm.
 * User: raul
 * Date: 2/12/16
 * Time: 10:26 AM
 */
use \Doctrine\ORM\Query\QueryException;
class ErrorHandler{

    static function errorInQuery($message = "There is some error with your query",$errorCode = ""){

        throw new QueryException($message);
    }


}