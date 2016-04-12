<?php
/**
 * Created by PhpStorm.
 * User: raul
 * Date: 2/25/16
 * Time: 6:57 PM
 */

namespace AppBundle\lib;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\DBAL\Query\QueryException;
use AppBundle\Entity\Projects;

class ProjectsLib
{
    static function createProject(Registry $db, $username, $projName, $url = null){
        $user = UserLib::getUser($db,$username);
        if(isset($user)){
                $man = $db->getManager();
                $man->persist(new Projects($user, $projName, $url));
                $man->flush();
        }
    }
    static function getProject(Registry $db, $key){
        if(!isset($db))
            throw new QueryException("No database");
        $proj = $db->getRepository("AppBundle:Projects")->findByApiKey($key);
        return $proj;
    }
}