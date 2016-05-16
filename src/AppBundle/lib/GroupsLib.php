<?php
/**
 * Created by PhpStorm.
 * User: raul4916
 * Date: 4/11/16
 * Time: 4:28 PM
 */

namespace AppBundle\lib;
use AppBundle\Entity\Groups;
use Doctrine\Bundle\DoctrineBundle\Registry;


class GroupsLib
{
    static function createGroup(Registry $db,$type){
        if(is_array($type)){
            $groups = [];

            foreach($type as $t){
                $groups[] = self::createGroup($db,$t);
            }
            return $groups;
        }elseif(($group = self::getGroup($db,$type))!=null){
            return $group;
        }
        else {
            $man = $db->getManager();
            $group = new Groups($type);
            $man->persist($group);
            $man->flush();
            return $group;
        }
    }
    static function getGroup(Registry $db,$type){
        $group = $db->getRepository("AppBundle:Groups")->findByType($type);
        if(array_key_exists(0,$group)){
            return $group[0];
        }
        return null;
    }
    static function exists($db,$type){
        $group = self::getGroup($db,$type);
        return isset($group);
    }
    function changeGroup($db){}
}