<?php

/**
 * Created by PhpStorm.
 * User: raul4916
 * Date: 2/13/16
 * Time: 8:33 PM
 */


namespace AppBundle\lib;

use AppBundle\Entity\Surveys;
use Symfony\Component\Config\Definition\Exception\Exception;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\DBAL\Query\QueryException;
use AppBundle\Error\JSONException;

class SurveyLib
{
    //json structure:
    // {username:"bla", "question":"blah", type = string of type(rating, multiple_choice)
    //   responses: [1,2,3], allow_comments : T/F, groups_allowed: string (ex: New_user)}

    static function createSurvey(Registry $db, $json_array){
        if(isset($json_array) && isset($db)){
            if(count($json_array) < 8)
                throw new JSONException("Missing a variable on JSON. Check format");
            $username =  $json_array["username"];
            $question = $json_array["question"];
            $type = $json_array["type"];
            $responses = $json_array["responses"];
            $allowComments = $json_array["allow_comments"];
            $groupsAllowed = $json_array["groups_allowed"];
            $website = $json_array["website"];
            $webnum = $json_array["webnum"];
            if(array_key_exists("channel", $json_array)){
                $channel = $json_array["channel"];
            }
            else{
                $channel = null;
            }
            switch($type){
                case "rating":
                    $type = DefinitionLib::RATING;
                    break;
                case "multiple_choice":
                    $type = DefinitionLib::MULTIPLE_CHOICE;
                    break;
                case "yes_no":
                    $type = DefinitionLib::YES_NO;
                    break;
            }
            if($allowComments == "true")
                $allowComments = DefinitionLib::COMMENTS_ALLOWED;
            else
                $allowComments = DefinitionLib::COMMENTS_BLOCKED;
            switch($groupsAllowed){
                case 'all': $groupsAllowed = DefinitionLib::NEW_USER;
            }
            $user = UserLib::getUser($db, $username);
            $man = $db->getManager();

            $page = PagesLib::createAndGetPage($db,$website,$webnum,$channel);
            $responses = ResponsesLib::createResponses($responses);
            if($channel==null) {
                $survey = new Surveys($user, $question, $type, $responses, $allowComments, $groupsAllowed, $page);
            }else{
                $survey = new Surveys($user, $question, $type, $responses, $allowComments, $groupsAllowed, $page, $channel);
            }
            $man->persist($survey);
            $man->flush();
            return true;
        }
        throw new JSONException("JSON was NULL, please send a correct request");
    }
    static function getSurvey(Registry $db,$fid){
        if(!isset($db)) {
            throw new QueryException("No database");
        }
        $survey = $db->getRepository("AppBundle:Survey")->find($fid);
        return $survey;
    }
    static function changeData(Registry $db,$data,$dataObj,$fid){
        $survey = self::getSurvey($db,$fid);
        switch($data){
            case "question":
                $survey->setQuestion($dataObj);
                break;
            case "type":
                $survey->setType($dataObj);
                break;
            case "allow_comments":
                if($dataObj == DefinitionLib::COMMENTS_ALLOWED || $dataObj == DefinitionLib::COMMENTS_BLOCKED) {
                    $survey->setAllowComments($dataObj);
                }
                break;
            case "groups_allowed":
                $survey->setGroupsAllowed($dataObj);
                break;
            case "status":
                $survey->setStatus($dataObj);
                break;
            case "date_modified":
                $survey->setDateModified(time());
                break;
            default:
                new Exception("Wrong dataObj sent");
        }
        $survey->flush();
    }


}