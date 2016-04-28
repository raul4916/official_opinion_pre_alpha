<?php

/**
 * Created by PhpStorm.
 * User: raul
 * Date: 2/12/16
 * Time: 2:42 PM
 */
namespace AppBundle\lib;

class DefinitionLib
{
    //STATUS CONSTANTS
    const ACTIVE = 1;
    const DELETED = 2;
    const CONNECTED = 3;
    const RESOLVED = 4;
    const UNDER_REVIEW = 5;
    const INACTIVE = 6;

    //EMAIL AND COMMENTS CONSTANTS
    const EMAIL_CONFIRMED = 10;
    const EMAIL_NOT_CONFIRMED = 11;
    const COMMENTS_ALLOWED = 12;
    const COMMENTS_BLOCKED = 13;


    //RESPONSES TYPE
    const RATING = 20;
    const MULTIPLE_CHOICE = 21;
    const YES_NO = 22;




    //SUCCESS/FAILURE
    const SUCCESS = 200;
    const FAILURE = 500;

    //GROUP CONSTANTS
    const NEW_USER = 'NEW_USER';
    const ADMIN = 'ADMIN';
    const MEMBER  = 'MEMBER';
    const SENIOR_MEMBER = 'SENIOR_MEMBER';
    const MODERATOR = 'MODERATOR';
    const GUEST = 'GUEST';

    //STRING CONSTANTS

     const MAIN_URL = "http://localhost/";
     const DOES_NOT_EXIST = "DOES NOT EXIST";
}