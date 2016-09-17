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
        $s_type_keys = array("un","ln","fn");
                
        $s_types = array(array("val" => $s_type_keys[0], "txt" => "User Name", "sel" => null ),
            array("val" => $s_type_keys[1], "txt" => "Last Name", "sel" => null),
            array("val" => $s_type_keys[2], "txt" => "First Name", "sel" => null));

        $s_type = $request->get('s_type', null);
        
        $s_key = $request->get('s_key', null);

        if( !in_array($s_type, $s_type_keys)){
            $s_type = $s_type_keys[0];
        }

        foreach ($s_types as $key => $value) {
            if ($value["val"] == $s_type) {
                $s_types[$key]["sel"] = "selected";
            }
        }

        //Find all users for a given search type and search key.

        $users = array( array("uname"=>"jdoe",'name'=>"John Doe",'email'=>'jdoe@doe.com','phone'=>'(212) 999-9999'),
                        array("uname"=>"jdoe",'name'=>"John Doe",'email'=>'jdoe@doe.com','phone'=>'(212) 999-9999'),
                        array("uname"=>"jdoe",'name'=>"John Doe",'email'=>'jdoe@doe.com','phone'=>'(212) 999-9999'));
        $data = array("users"=>$users,"s_key"=>$s_key,"s_types"=>$s_types);
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
