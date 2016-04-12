<?php
/**
 * Created by PhpStorm.
 * User: raul4916
 * Date: 4/11/16
 * Time: 4:28 PM
 */

namespace AppBundle\lib;

use AppBundle\Entity\Tags;
use Doctrine\Bundle\DoctrineBundle\Registry;

class TagsLib
{
    static function createTags(Registry $db, $tagName){
        $man = $db->getManager();
        $tag = new Tags($tagName);
        $man->persist($tag);
        $man->flush();
        return $tag;
    }
    function getTags(Registry $db){
        $tag = $db->getRepository("AppBundle:Tags")->findBy();
        if(array_key_exists(0,$tag)){
            return $tag[0];
        }
        return false;
    }
    function changeTags($db){}
}