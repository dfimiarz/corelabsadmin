<?php

namespace CoreLABSBundle\Controller;

use CoreLABSBundle\Entity\CoreUserDAO;
use CoreLABSBundle\Entity\CoreUserVO;
use CoreLABSBundle\Utils\CryptoService as CryptoService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        
        $conn = $this->get("database_connection");
        
        \var_dump($conn);
        exit();
        
        $s_types = array("un"=>array( "txt" => "User Name", "sel" => null ),
            "ln"=>array( "txt" => "Last Name", "sel" => null),
            "fn"=>array( "txt" => "First Name", "sel" => null));

        $s_type = $request->query->getAlpha('s_type', "un" );
        
        $s_key = $request->query->get("s_key", null);

        foreach ($s_types as $key => $value) {
            if ($key == $s_type) {
                $s_types[$key]["sel"] = "selected";
            }
        }
        
        /* @var $crypto_service CryptoService */
        $crypto_service = $this->get("core_labs.crypto_service");
        $userDAO = new CoreUserDAO($this->get("core_labs.con_mysqli"));

        /* @var $users CoreUserVO[] */
        $users = $userDAO->findUsers($s_key, $s_type);

        $data = array("users"=>$users,"s_key"=>$s_key,"s_types"=>$s_types);
        return $this->render('CoreLABSBundle:Default:admin.manage.users.html.twig',$data);
        
        
    }
    
     /**
     * @Route("/dashboard/users/{id}", name="user_details")
     */
    public function userDetailsAction($id)
    {
        //$mysqli = $this->get("core_labs.con_mysqli");
        
        
        
        return new Response($id);
    }
}
