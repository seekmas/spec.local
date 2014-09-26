<?php

namespace App\FrontendBundle\Controller;

use App\BackendBundle\Controller\CoreController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SearchController extends CoreController
{
    /**
     * @Route("/search")
     * @Template()
     */
    public function indexAction()
    {


        return array(

        );
    }

}
