<?php
/**
 * Created by PhpStorm.
 * User: raul4916
 * Date: 4/11/16
 * Time: 4:28 PM
 */

namespace AppBundle\lib;
use AppBundle\Entity\Reports;
use AppBundle\Entity\Surveys;
use AppBundle\Entity\Tags;
use Doctrine\Bundle\DoctrineBundle\Registry;


class ReportsLib
{
    function createReports(Registry $db,$obj, \Doctrine\Common\Collections\ArrayCollection $reason){
        $man = $db->getManager();
        $report = new Reports($obj,$reason);
        $man->persist($report);
        $man->flush();
        return $report;
    }
    function getReports(Registry $db, $id){
        $report = $db->getRepository("AppBundle:Reports")->findById($id);
        if(array_key_exists(0,$report)){
            return $report[0];
        }
        return false;
    }
    function changeReports(Registry $db){}
}