<?php
/**
 * Created by PhpStorm.
 * User: raul4916
 * Date: 4/11/16
 * Time: 4:28 PM
 */

namespace AppBundle\lib;
use AppBundle\Entity\Responses;
use Doctrine\Bundle\DoctrineBundle\Registry;

class ResponsesLib
{
    static function createResponses(Registry $db,array $answers){
        $man = $db->getManager();
        $responses = new \Doctrine\Common\Collections\ArrayCollection();;
        foreach($answers as $answer) {
            if($response = self::getResponses($answer)){
                $responses.add($response);
            }else {
                $response = new Responses($answer);
                $man->persist($response);
                $man->flush();
                $responses.add($response);
            }
        }
        return $responses;
    }
    static function getResponses(Registry $db,$answer){
        $response = $db->getRepository("AppBundle:Responses")->findByAnswer($answer);
        if(array_key_exists(0,$response)){
            return $response[0];
        }
        return false;
    }
    function changeResponses(Registry $db){}
}