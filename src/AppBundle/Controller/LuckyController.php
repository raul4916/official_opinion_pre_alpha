<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends Controller
{



    /**
     * @Route("/lucky")
     */
    public function numberAction()
    {
        $this->addFlash(
            'notice',
            'Your changes were saved!'
        );
        sleep(1);
        return $this->redirect("bob/lol");
//        return $this->render("default/hello.html");

    }

}