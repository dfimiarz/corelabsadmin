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
     * @Route("/", name="start")
     */
    public function indexAction()
    {
        return $this->render('CoreLABSBundle:Default:index.html.twig');
    }
    
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function adminDashboardAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('CoreLABSBundle:Default:admin.dashboard.html.twig');
    }
    
    /**
     * @Route("/dashboard/users", name="manage_users")
     */
    public function listUsersAction(Request $request)
    {
        
        $result_limit = 10;
        
        $s_term = $request->get('s_term');
        $s_type = $request->get('s_type');
        $s_page = $request->get('page',0);
        
        $users = array( array("uname"=>$s_term,'name'=>$s_type,'email'=>$s_page,'phone'=>'(212) 999-9999'),
                        array("uname"=>"jdoe",'name'=>"John Doe",'email'=>'jdoe@doe.com','phone'=>'(212) 999-9999'),
                        array("uname"=>"jdoe",'name'=>"John Doe",'email'=>'jdoe@doe.com','phone'=>'(212) 999-9999'),
                        array("uname"=>"jdoe",'name'=>"John Doe",'email'=>'jdoe@doe.com','phone'=>'(212) 999-9999'),
                        array("uname"=>"jdoe",'name'=>"John Doe",'email'=>'jdoe@doe.com','phone'=>'(212) 999-9999'),
                        array("uname"=>"jdoe",'name'=>"John Doe",'email'=>'jdoe@doe.com','phone'=>'(212) 999-9999'),
                        array("uname"=>"jdoe",'name'=>"John Doe",'email'=>'jdoe@doe.com','phone'=>'(212) 999-9999'),
                        array("uname"=>"jdoe",'name'=>"John Doe",'email'=>'jdoe@doe.com','phone'=>'(212) 999-9999'),
                        array("uname"=>"jdoe",'name'=>"John Doe",'email'=>'jdoe@doe.com','phone'=>'(212) 999-9999'),
                        array("uname"=>"jdoe",'name'=>"John Doe",'email'=>'jdoe@doe.com','phone'=>'(212) 999-9999'));
        
        $data = array("users"=>$users,"s_term"=>$s_term,"s_type"=>$s_type,"page"=>$s_page,"next"=>true);
        return $this->render('CoreLABSBundle:Default:admin.manage.users.html.twig',$data);
    }
    
     /**
     * @Route("/dashboard/users/{enc_id}", name="user_details")
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
