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

    static function createSurvey(Registry $db, $json_array)
    {
        if (isset($json_array) && isset($db)) {
            if (count($json_array) < 8)
                throw new JSONException("Missing a variable on JSON. Check format");
            $username = $json_array["username"];
            $question = $json_array["question"];
            $type = $json_array["type"];
            $responses = $json_array["responses"];
            $allowComments = $json_array["allow_comments"];
            $groupsAllowed = $json_array["groups_allowed"];
            if (array_key_exists("website", $json_array)) {
                $website = $json_array["website"];
            } else {
                $website = null;
            }
            if (array_key_exists("channel", $json_array)) {
                $channel = $json_array["channel"];
            } else {
                $channel = null;
            }
            switch ($type) {
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
            if ($allowComments == "true")
                $allowComments = DefinitionLib::COMMENTS_ALLOWED;
            else
                $allowComments = DefinitionLib::COMMENTS_BLOCKED;

            $user = UserLib::getUser($db, $username);
            $man = $db->getManager();

            $page = PagesLib::createPage($db, $website, $channel);
            $responses = ResponsesLib::createResponses($db,$responses);
            if ($channel == null) {
                $survey = new Surveys($user, $question, $type, $responses, $allowComments, $page);
            } else {
                $survey = new Surveys($user, $question, $type, $responses, $allowComments, $page, $channel);
            }
            $man->persist($survey);
            $man->flush();
            return true;
        }
        throw new JSONException("JSON was NULL, please send a correct request");
    }

    static function getSurvey(Registry $db, $fid)
    {
        if (!isset($db)) {
            throw new QueryException("No database");
        }
        $survey = $db->getRepository("AppBundle:Survey")->find($fid);
        return $survey;
    }
    static function surveysToArray($surveys){
        $arr = [];
        if(!is_array($surveys)) {
            $surveys = array($surveys);
        }
        foreach($surveys as $surv){
            $survey = [];
            $survey["user"] = $surv->getUser()->getUsername();
            $survey["question"] = $surv->getQuestion();
            $survey["type"] = $surv->getType();
            $responses=[];
            $totalResults = 0;
            foreach($surv->getResponses() as $response){
                $answer = $response->getAnswer();
                $result[$answer] = $response->getResult($surv->getId());
                $totalResults += $result[$answer];
                $responses[] = array("answer"=>$answer, "results" => $result,"totalResults" =>$totalResults);
            }
            $survey["responses"] = $responses;
            $survey["allow_comments"] = $surv->allowComments();
            $survey["page"]=$surv->getPage()->getWebsite();
            $survey["channel"]=$surv->getChannel()->getName();
            $arr[]=$survey;
        }
        return $arr;

        $arr["user"] = $surv->getUser()->getUsername();
        $arr["question"] = $surv->getQuestion();
        $arr["type"] = $surv->getType();
        $responses=[];
        $totalResults = 0;
        foreach($surv->getResponses() as $response){
            $answer = $response->getAnswer();
            $result[$answer] = $response->getResult($surv->getId());
            $totalResults += $result[$answer];
            $responses[] = array("answer"=>$answer, "results" => $result,"totalResults" =>$totalResults);
        }
        $arr["responses"] = $responses;
        $arr["allow_comments"] = $surv->allowComments();
        $arr["page"]=$surv->getPage()->getWebsite();
        $arr["channel"]=$surv->getChannel()->getName();
    }
}