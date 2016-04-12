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
    function createGroups(Registry $db,$type){
        $man = $db->getManager();
        $group = new Groups($type);
        $man->persist($group);
        $man->flush();
        return $group;
    }
    function getGroups(Registry $db){
        $page = $db->getRepository("AppBundle:Groups")->findByWebsiteInNumbers($webnum);
        if(array_key_exists(0,$page)){
            return $page[0];
        }
        return false;
    }

    function changeGroups($db){}
}