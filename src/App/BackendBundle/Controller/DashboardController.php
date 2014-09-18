<?php

namespace App\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Process;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DashboardController extends CoreController
{
    /**
     * @Route("/" , name="dashboard")
     * @Template()
     */
    public function indexAction(Request $request)
    {


        return [];
    }
}
