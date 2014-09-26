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
        if($this->get('security.context')->isGranted('ROLE_USER'))
        {
            return $this->redirect($this->generateUrl('home_page'));
        }

        return [];
    }
}