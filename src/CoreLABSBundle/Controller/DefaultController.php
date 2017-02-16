<?php

namespace CoreLABSBundle\Controller;

use CoreLABSBundle\Entity\CoreUserDAO;
use CoreLABSBundle\Entity\CoreUserVO;
use CoreLABSBundle\Utils\CryptoService as CryptoService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Connection as DBLAConn;
use CoreLABSBundle\Entity\CoreUserSearchOptions as SearchOptions;
use CoreLABSBundle\Utils\PaginatorCntr;

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
                  
        $filter_types = array("un"=>array( "txt" => "User Name", "sel" => null ),
            "ln"=>array( "txt" => "Last Name", "sel" => null),
            "fn"=>array( "txt" => "First Name", "sel" => null));

        /* @var $options CoreUserSearchOptions */
        $options = new SearchOptions($request);
        
        /**
         * Determine which filter was selected
         */
        if(array_key_exists($options->fType, $filter_types)){
            $filter_types[$options->fType]["sel"] = "selected";
        }
        
        $userDAO = new CoreUserDAO($this->get("database_connection"));

        /* @var $users CoreUserVO[] */
        $users = $userDAO->getUsers($options);
             
        $links = PaginatorCntr::generateLinks($options, $users);
          
        /*
         * Prepare data to send to the template
         */
        $data = array("users"=>$users,"f_val"=>$options->fValue,"f_types"=>$filter_types,"pagination"=>$links);
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
