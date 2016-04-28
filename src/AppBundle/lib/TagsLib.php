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
    static function createTag(Registry $db, $tagName){
        if(($tag = self::getTag($db,$tagName))!=null){
            return $tag;
        }
        $man = $db->getManager();
        $tag = new Tags($tagName);
        $man->persist($tag);
        $man->flush();
        return $tag;
    }
    static function getTag(Registry $db,$tagname){
        $tag = $db->getRepository("AppBundle:Tags")->findByTag($tagname);
        if(array_key_exists(0,$tag)){
            return $tag[0];
        }
        return null;
    }

}