<?php
/**
 * Created by PhpStorm.
 * User: raul
 * Date: 2/12/16
 * Time: 12:55 PM
 */
namespace AppBundle\lib;


use AppBundle\Entity\Users;
use AppBundle\Entity\Locations;
use Doctrine\DBAL\Query\QueryException;
use Doctrine\Bundle\DoctrineBundle\Registry;

class UserLib
{
    /**
    ($id, $username, $date_create, $date_login, $email, $email_confirmed, $fname,
    $lname,$gender, $location, $age, $primary_lang, $race, $origin,$status,$group,
    $authentication)
     *
     */

    static function addUser(Registry $db,$username,$password, $date_create, $date_login, $email,$fname = null, $lname = null,
                            $gender = null,$city = null,$state = null,$country = null, $age= null, $primary_lang= null, $race = null, $origin = null,
                            $status = DefinitionLib::ACTIVE,$email_confirmed= DefinitionLib::EMAIL_NOT_CONFIRMED,$group = DefinitionLib::NEW_USER)
    {
        $man  = $db->getManager();
        $fid = password_hash($password,PASSWORD_DEFAULT);
        $location = new Locations($country,$state,$city);
        $man->persist($location);

        $user = new Users($username,$fid,$date_create, $date_login, $email,$email_confirmed, $fname,
            $lname,$gender,$location,$age, $primary_lang,$race,$origin,$status,$group);

        $man->persist($user);
        $man->flush();

    }
    /**
     * @param $db
     * @param $username
     * @param $pass
     * @return Users
     * @throws QueryException
     */
    static function getUser(Registry $db, $username){
        if(!isset($db))
            throw new QueryException("No database");
        $user = $db->getRepository('AppBundle:Users')->findByUsername($username)[0];
        if( !$user->getEmailConfirmed() ==  DefinitionLib::EMAIL_NOT_CONFIRMED)
            throw new QueryException("Email not confirmed");
//        if(password_verify($password,$user->getFid())) {
//            return $user;
//        }
        return $user;
        throw new QueryException("username or password is incorrect please try again");

    }
    static function deleteUser(Registry $db,$username){
        self::changeData($db,"status",DefinitionLib::DELETED,$username);
    }
    static function  changeData(Registry $db, $data,$dataObj, $username){
        $user = self::getUser($db,$username);
        switch($data){
            case "date_login":
                $time = time();
                $user->setDateLogin($time);
                break;
            case "gender":
                $user->setGender($dataObj);
                break;
            case "email":
                $user->setEmail($dataObj);
                break;
            case "email_confirmed":
                $email = $user->getEmail();
                if(isset($email))
                    $user->setEmailConfirmed($dataObj);
                else
                    throw new QueryException("Email was not set please type the email");
                break;
            case "fname":
                $user->setFname($dataObj);
                break;
            case "lname":
                $user->setFname($dataObj);
                break;
            //will need an array.  Format {country, State, City}
            case "location":
                $location = new Locations($dataObj[0],$dataObj[1],$dataObj[2]);
                $user->setLocation($location);
                $man = $db->getManager();
                $man->persist($location);
                $man>flush();
                break;
            case "primary_lang":
                $user->setPrimaryLang($dataObj);
                break;
            case "race":
                $user->setRace($dataObj);
                break;
            case "origin":
                $user->setOrigin($dataObj);
                break;
            case "status":
                $user.setStatus($dataObj);
                break;
            default:
                new Exception("Wrong dataObj sent");
        }
        $user->flush();
    }
    static function addFollower(Registry $db,$follower,$toFollow){
        if(!isset($db))
            throw new QueryException("No database");
        $follower = self::getUser($db,$follower);
        $toFollow = self::getUser($db,$toFollow);
        $toFollow->addFollowing($follower);
    }


}