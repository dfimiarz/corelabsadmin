<?php

namespace CoreLABSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CoreLABSBundle\Utils\CryptoService as CryptoService;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="admin_home")
     */
    public function indexAction()
    {
        return $this->render('CoreLABSBundle:Default:index.html.twig');
    }
    
    /**
     * @Route("/listusers", name="listusers")
     */
    public function listUsersAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('CoreLABSBundle:Default:list_users.html.twig');
    }
    
     /**
     * @Route("/user/{enc_id}", name="showuserinfo")
     */
    public function userDetailsAction($enc_id)
    {
        $mysqli = $this->get("core_labs.con_mysqli");
        
        
        /* @var $crypto CryptoService */
        $crypto = $this->get("core_labs.crypto_service");
        $value = $crypto->encrypt($enc_id);
        return new Response("value: " . $value);
    }
}
