<?php

namespace App\FrontendBundle\Controller;

use App\BackendBundle\Controller\CoreController;
use App\BackendBundle\Entity\Purchase;
use App\BackendBundle\PurchaseStatus;
use App\BackendBundle\Util\RandomDataGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class PayController extends CoreController
{
    /**
     * @Route("/{lessonId}/payment" , name="payment")
     * @Template()
     */
    public function indexAction(Request $request , $lessonId)
    {
        $lesson = $this->get('lesson.entity')->find($lessonId);
        $payment = $this->get('alipay.payment');

        if($lesson == NULL)
        {
            $this->flash('danger' , '找不到课程');
        }

        $user = $this->getUser();
        $purchase = $payment->orderIsExist($lesson,$user,PurchaseStatus::Cart);

        if( $purchase == NULL)
        {
            $purchase = $payment->createOrder($lesson,$user);
        }

        echo $this->get('alipay.payment')
             ->setNotify('finish_payment_notify')
             ->setAnsy('finish_payment_ansy')
             ->createPayment($purchase->getId());

        return [];
    }

    /**
     * @Route("/{lessonId}/cart" , name="cart")
     * @Template()
     */
    public function cartAction(Request $request , $lessonId)
    {
        $payment = $this->get('alipay.payment');

        $lesson = $this->get('lesson.entity')->find($lessonId);

        if($lesson == NULL)
        {
            $this->flash('danger' , '找不到课程');
        }
        $user = $this->getUser();
        $exist = $payment->orderIsExist($lesson,$user,PurchaseStatus::Cart);

        if( $exist)
        {
            $this->flash('success' , '已经添加成功');
        }else
        {
            $purchase = $payment->createOrder($lesson,$user);
            if( $purchase->getId())
                $this->flash('success' , '已经添加成功');
            else
                $this->flash('danger' , '添加失败');
        }

        return $this->to('home_lesson' , ['id'=>$lessonId]);
    }

    /**
     * @Route("/finish_payment_notify" , name="finish_payment_notify")
     * @Template()
     */
    public function finishNotifyAction(Request $request)
    {
        $payment = $this->get('alipay.payment');
        $payment->finishPayment('notify');

        return [];
    }

    /**
     * @Route("/finish_payment_ansy" , name="finish_payment_ansy")
     * @Template()
     */
    public function finishAnsyAction(Request $request)
    {
        $payment = $this->get('alipay.payment');
        $payment->finishPayment('return');

        return [];
    }
}