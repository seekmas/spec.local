<?php

namespace App\FrontendBundle\Controller;

use App\BackendBundle\Controller\CoreController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CalenderController extends CoreController
{
    /**
     * @Route("/arrangement" , name="home_calender")
     * @Template()
     */
    public function indexAction()
    {

        return [

        ];
    }


}