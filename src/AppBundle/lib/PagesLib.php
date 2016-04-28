<?php
/**
 * Created by PhpStorm.
 * User: raul4916
 * Date: 4/7/16
 * Time: 9:56 PM
 */
namespace AppBundle\lib;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Config\Definition\Exception\Exception;
use AppBundle\Entity\Pages;

class PagesLib
{
    static function createPage(Registry $db, $website, $webnum, $channel = null){
        if(($page = self::getPage($db,$webnum))){
            self::createPage($db, $website, $webnum, $channel);
            $page = self::getPage($db, $webnum);
        }
        $man = $db->getManager();
        $man->persist($page);
        $man->flush();
        return $page;
    }
    static function getPage(Registry $db, $website){
        $page = $db->getRepository("AppBundle:Pages")->findByWebsite($website);
        if(array_key_exists(0,$page)){
            return $page[0];
        }
        return false;
    }
    static function createAndGetPage(Registry $db,$website,$webnum,$channel=null){
        if(!$page = self::getPage($db,$webnum)){
            self::createPage($db, $website, $webnum, $channel);
            $page = self::getPage($db, $webnum);
        }
        return $page;
    }

}