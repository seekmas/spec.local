<?php

namespace App\FrontendBundle\Controller;

use App\BackendBundle\Controller\CoreController;
use App\BackendBundle\Entity\Checkin;
use App\BackendBundle\Entity\Privates;
use App\BackendBundle\Form\PrivatesType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class UserController extends CoreController
{

    /**
     * @Route("/user" , name="user_home")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $privates = $user->getPrivates();
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


        $purchases = $this->get('purchase.entity')->findBy(['userId'=>$user->getId()]);

        return ['form'=>$form->createView(),'privates'=>$privates,'purchases'=>$purchases];
    }

    /**
     * @Route("/check-in" , name="check_in")
     * @Template()
     */
    public function checkInAction(Request $request)
    {

        $user = $this->getUser();
        $checkin = $this->get('checkin.entity')
                        ->createQueryBuilder('c')
                        ->select('c')
                        ->where('c.userId = '.$user->getId())
                        ->orderBy('c.id' , 'desc')
                        ->getQuery()
                        ->getResult();
        $checkin = $checkin[0];
        if($checkin == NULL)
        {
            $em = $this->getEntityManager();
            $checkin = new Checkin();
            $em->persist($checkin);
            $checkin->setUser($user);
            $checkin->setCheckinAt(new \Datetime());
            $em->flush();

            $this->flash('success' , '首次签到成功!');
        }else if( $checkin->getCheckinAt()->format('Y-m-d') == date('Y-m-d') )
        {
            $this->flash('success' , '已经签到过了 请勿重复签到!');
        }else
        {

            $em = $this->getEntityManager();
            $checkin = new Checkin();
            $em->persist($checkin);
            $checkin->setUser($user);
            $checkin->setCheckinAt(new \Datetime());
            $em->flush();

            $this->flash('success' , '今日签到成功!');
        }

        return $this->to('user_home');    }
}