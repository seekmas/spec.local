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

        if($lesson == NULL)
        {
            $this->flash('danger' , '找不到课程');
        }

        $user = $this->getUser();
        $purchase = $this->get('alipay.payment')->orderIsExist($lesson,$user,PurchaseStatus::Cart);

        if( $purchase == NULL)
        {
            $purchase = $this->get('alipay.payment')->createOrder($lesson,$user);
        }

        echo $this->get('alipay.payment')->createPayment($purchase->getId());

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
        $exist = $this->get('alipay.payment')->orderIsExist($lesson,$user,PurchaseStatus::Cart);

        if( $exist)
        {
            $this->flash('success' , '已经添加成功');
        }else
        {
            $purchase = $this->get('alipay.payment')->createOrder($lesson,$user);
            if( $purchase->getId())
                $this->flash('success' , '已经添加成功');
            else
                $this->flash('danger' , '添加失败');
        }

        return $this->to('home_lesson' , ['id'=>$lessonId]);
    }
}