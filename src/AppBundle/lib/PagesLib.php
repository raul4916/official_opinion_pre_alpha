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
        try{
            if ($channel == null) {
                $page = new Pages($website, $webnum);
            } else {
                $page = new Pages($website, $webnum, $channel);
            }
        }catch(Exception $e){
            echo "caught it";
        }
        $man = $db->getManager();
        $man->persist($page);
        $man->flush();
    }
    static function getPage(Registry $db, $webnum){
        $page = $db->getRepository("AppBundle:Pages")->findByWebsiteInNumbers($webnum);
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