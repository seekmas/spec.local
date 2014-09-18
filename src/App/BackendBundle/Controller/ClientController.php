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
        $users = $this->get('user.entity')->findAll();

        return ['users'=>$users ];
    }
}
