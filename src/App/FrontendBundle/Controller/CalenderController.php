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
        ld($this->getUser());
        $this->get('mail.notify')
             ->notify('云学院NotificationMessage' ,
                      'Composer will automatically download all required files, and install them for you. All that is left to do is to update your AppKernel.php file, and register the new bundle');

        return [

        ];
    }
}