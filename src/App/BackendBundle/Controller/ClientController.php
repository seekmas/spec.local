<?php

namespace App\BackendBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Process;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ClientController extends CoreController
{

    /**
     * @Route("/user/{userId}" , name="user_manage")
     * @Template()
     */
    public function indexAction(Request $request , $userId = null)
    {
        $users = $this->get('user.paginator')->getPagination();

        return ['users'=>$users ];
    }

    /**
     * @Route("/orders" , name="orders_manage")
     * @Template()
     */
    public function orderAction(Request $request , $userId = null)
    {
        $orders = $this->get('purchase.paginator')->setPerpage(30)->getPagination();

        return ['orders'=>$orders ];
    }
}
