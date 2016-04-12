<?php
/**
 * Created by PhpStorm.
 * User: raul
 * Date: 2/11/16
 * Time: 4:18 PM
 */
namespace AppBundle\Controller;

use AppBundle\Error\JSONException;
use AppBundle\lib\DefinitionLib;
use AppBundle\lib\ProjectsLib;
use AppBundle\lib\SurveyLib;
use AppBundle\lib\UserLib;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\AcceptHeader;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Doctrine\DBAL\Query\QueryException;



class RESTController extends Controller
{

    /**
     * @Route ("/check")
     */
    function testing(){
        ;
    }

    /**
     * @Route("/json/{id}", name = "requestsCheck")
     */
    public function requestCheck($id, Request $request)
    {
        $db = $this->getDoctrine();
//        $proj = ProjectsLib::getProject($db, $id);
//        if(!isset($proj)){
//            return new Response("The ID is not valid");
//        }
        $json = $request->getContent();
        $json = json_decode($json,true);
        switch($id){
            case "create-user":
                /**
                 *    static function addUser(Registry $db,$pass, $username, $date_create, $date_login, $email,$fname, $lname,
                $city,$state,$country, $age= 13, $primary_lang= "english", $race, $origin,
                $status = ACTIVE,$email_confirmed= DefinitionLib::EMAIL_NOT_CONFIRMED,$group = DefinitionLib::NEW_USER)
                 */
                if(($username = $json["username"]) == null){
                    throw new QueryException("Error with the username, please type correctly");
                }
                if(!preg_match("/^[A-Za-z]([A-Za-z]|\d)*/", $json["username"])) {
                    throw new QueryException("Error with the username, please type correctly");
                }
                if(($password = $json["password"]) == null){
                    throw new QueryException("Error with the password, please type correctly");
                }
                if(($email = $json["email"]) == null){
                    throw new QueryException("Error with the email, please type correctly");
                }
                if(array_key_exists("fname",$json)){
                    $fname = $json["fname"];
                }else{
                    $fname = null;
                }
                if(array_key_exists("lname",$json)){
                    $lname = $json["lname"];
                }else{
                    $lname = null;
                }
                if(array_key_exists("gender",$json)){
                    $gender = $json["gender"];
                }else{
                    $gender = null;
                }
                if(array_key_exists("city",$json)){
                    $city = $json["city"];
                }else{
                    $city = null;
                }
                if(array_key_exists("state",$json)){
                    $state = $json["state"];
                }else{
                    $state = null;
                }
                if(array_key_exists("country",$json)){
                    $country = $json["country"];
                }else{
                    $country = null;
                }
                if(array_key_exists("primary_lang",$json)){
                    $prim_lang = $json["primary_lang"];
                }else{
                    $prim_lang = null;
                }
                if(array_key_exists("age",$json)){
                    $age = $json["age"];
                }else{
                    $age = null;
                }
                if(array_key_exists("origin",$json)){
                    $origin = $json["origin"];
                }else{
                    $origin = null;
                }
                if(array_key_exists("race",$json)){
                    $race = $json["race"];
                }else{
                    $race = null;
                }

                UserLib::addUser($db, strtolower($username), $password,time(),time(),$email,$fname,$lname,
                    $gender,$city,$state,$country,$age,$prim_lang,$race,$origin);

                $response = json_encode(
                    array(
                        "status" => DefinitionLib::SUCCESS,
                        "return" => true
                    )
                );
                return new Response($response);
                break;
            case "getUserInfo":
                //still got to decide what to do with this
                $username = $json['username'];
                if(preg_match("/^[A-Za-z]([A-Za-z]|\d)*/", $username)) {
                    $this->username = $username;
                }
                $user = UserLib::getUser($db,$username);
                $response = json_encode(
                    array(
                        "status" => DefinitionLib::SUCCESS,
                        "return" => true,
                    )
                );
        }
        return new Response($response);

    }
    /**
     * @Route("/json/{id}/{website}", name = "surveys")
     */
    public function getSurveysForSite($id,$website, Request $request)
    {
        if ($id == "get-surveys") {

        } elseif ($id == "create-survey") {
            $json = $request->getContent();
            $data = json_decode($json, true);
            $data['username'] = "raul4916";//got to change this
            if($data["type"]=="yes_no") {
                $data["responses"] = ["yes", "no"];
            }
            if($data["type"]=="multiple_choice") {
            }
            if($data["type"]=="rating") {
                $data["responses"]=[1,2,3,4,5];
            }
            $data["webnum"]=$website;
            SurveyLib::createSurvey($this->getDoctrine(),$data);

            return new Response(json_encode($data));
        }elseif ($id == "survey-page"){
            $arr = ["response" => "DOES NOT EXIST"];
            return new Response(json_encode($arr));
        }
    }



//
//$json = json_encode(array('bob'=> $id));
//$arr = array('Content-Type' => 'application/json');
//AcceptHeader::fromString("application/json");
//$response = new Response($json,200,$arr);
//$response = $response->setCharset('ISO-8859-1');
//$response = $response->prepare($request);
//return $response;
}
