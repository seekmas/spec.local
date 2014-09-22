<?php

namespace App\FrontendBundle\Controller;

use App\BackendBundle\Controller\CoreController;
use App\BackendBundle\Entity\Privates;
use App\BackendBundle\Form\PrivatesType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;


class UserController extends CoreController
{

    /**
     * @Route("/user" , name="user_home")
     * @Template()
     */
    public function indexAction(Request $request)
    {

        $privates = $this->getUser()->getPrivates();
        if( $privates == NULL)
        {
            $privates = new Privates();
            $privates->setUser($this->getUser());
        }

        $tmpPhoto = $this->tmpPhotoHandle( $privates);

        $type = new PrivatesType();
        $form = $this->getForm($request,$type,$privates);
        if( $form->isValid())
        {
            $this->processForm($form,$privates,$tmpPhoto);
            $this->flash('success' , '资料更新成功');
            return $this->to('user_home');
        }
        $this->resetEntity($privates,$tmpPhoto);


        return ['form'=>$form->createView(),'privates'=>$privates];
    }
}