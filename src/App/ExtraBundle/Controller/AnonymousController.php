<?php

namespace App\ExtraBundle\Controller;

use App\BackendBundle\Controller\CoreController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AnonymousController extends CoreController
{
    /**
     * @Route("/" , name="anonymous")
     * @Template
     */
    public function indexAction(Request $request)
    {
        return [];
    }
}