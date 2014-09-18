<?php

namespace App\FrontendBundle\Controller;

use App\BackendBundle\Controller\CoreController;
use App\BackendBundle\Entity\Purchase;
use App\BackendBundle\PurchaseStatus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class PayController extends CoreController
{
    /**
     * @Route("/payment" , name="payment")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        return [];
    }

    /**
     * @Route("/{lessonId}/cart" , name="cart")
     * @Template()
     */
    public function cartAction(Request $request , $lessonId)
    {
        $lesson = $this->get('lesson.entity')->find($lessonId);
        if($lesson == NULL)
        {
            $this->flash('danger' , '找不到课程');
        }
        $user = $this->getUser();
        $exist = $this->get('purchase.entity')->findOneBy(
            ['userId'   => $user->getId() ,
             'lessonId' => $lessonId ,
             'statusId' => PurchaseStatus::Cart
            ]
        );

        if( $exist)
        {
            $this->flash('success' , '已经添加成功');
        }else
        {
            $purchase = new Purchase();
            $purchase->setUser($user);
            $purchase->setLesson($lesson);
            $purchase->setIsLocked(false);
            $purchase->setPrice($lesson->getPrice());
            $purchase->setStatusId(PurchaseStatus::Cart);
            $purchase->setCreatedAt(new \Datetime());
            $em = $this->getEntityManager();
            $em->persist($purchase);
            $em->flush();
            $this->flash('success' , '已经添加成功');
        }

        return $this->to('home_lesson' , ['id'=>$lessonId]);
    }
}