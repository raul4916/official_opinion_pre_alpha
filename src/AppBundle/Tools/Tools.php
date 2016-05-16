<?php

/**
 * Created by PhpStorm.
 * User: raul
 * Date: 2/25/16
 * Time: 6:47 PM
 */
namespace AppBundle\Tools;


    class Tools
    {
        static function random_str($length = 24, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
        {
            $str = '';
            $max = mb_strlen($keyspace, '8bit') - 1;
            for ($i = 0; $i < $length; ++$i) {
                $str .= $keyspace[random_int(0, $max)];
            }
            return $str;
        }

        static function str_to_int($str)
        {
            return intval(ord(strtolower($str)));
        }
    }