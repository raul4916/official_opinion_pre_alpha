<?php

namespace AppBundle\Controller;

use AppBundle\lib\DefinitionLib;
use AppBundle\lib\SurveyLib;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\HttpFoundation;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\AcceptHeader;
use AppBundle\lib\NetworkLib;


class DefaultController extends Controller
{

    /**
     * @Route("/")
     */
    public function testAction()
    {
//        $url = DefinitionLib::MAIN_URL . "json/1";
//        $result = NetworkLib::requestServer($url);
//        return $this->render("default/index.html.twig",['base_dir' => $_SERVER['REQUEST_URI']]);
        return $this->render("default/stoneybrook-lights.html");
    }

    /**
     * @Route("/userSignUp")
     */
    public  function registerUser(){
        return $this->render("default/register-user.html");
    }

}
