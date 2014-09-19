<?php

namespace App\BackendBundle\Payment;

use App\BackendBundle\PurchaseStatus;
use JMS\DiExtraBundle\Annotation as DI;

use App\BackendBundle\Entity\Lesson;
use App\BackendBundle\Entity\Purchase;
use App\BackendBundle\Entity\User;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


/**
 * @DI\Service("alipay.payment")
 */
class Alipay implements PaymentInterface
{
    protected $entityManager;

    protected $purchaseEntity;

    protected $request;

    protected $container;

    /**
     * @DI\InjectParams({
     *      "entityManager"  = @DI\Inject("doctrine.orm.entity_manager") ,
     *      "purchaseEntity" = @DI\Inject("purchase.entity") ,
     *      "request"        = @DI\Inject("request_stack") ,
     *      "container"      = @DI\Inject("service_container") ,
     *
     * })
     */
    public function __construct($entityManager,$purchaseEntity,$request,$container)
    {
        $this->entityManager = $entityManager;
        $this->purchaseEntity = $purchaseEntity;
        $this->request = $request->getMasterRequest();
        $this->container = $container;
    }

    public function createOrder(Lesson $lesson, User $user)
    {
        $purchase = new Purchase();
        $purchase->setUser($user);
        $purchase->setLesson($lesson);
        $purchase->setIsLocked(false);
        $purchase->setPrice($lesson->getPrice());
        $purchase->setStatusId(PurchaseStatus::Cart);
        $purchase->setCreatedAt(new \Datetime());
        $this->entityManager = $this->getEntityManager();
        $this->entityManager->persist($purchase);
        $this->entityManager->flush();

        return $purchase;
    }

    public function orderIsExist(Lesson $lesson, User $user, $statusId)
    {
        $order = $this->purchaseEntity->findOneBy(
            [   'userId'   => $user->getId() ,
                'lessonId' => $lesson->getId() ,
                'statusId' => PurchaseStatus::Cart
            ]
        );

        return $order ? $order : false;
    }

    public function createPayment($orderId)
    {

        $order = $this->container->get('purchase.entity')->find($orderId);

        $config = $this->getParams();
        $alipay_config['partner'] = $config->getPid();
        $alipay_config['key'] = $config->getPkey();

        //签名方式 不需修改
        $alipay_config['sign_type']    = strtoupper('MD5');

        //字符编码格式 目前支持 gbk 或 utf-8
        $alipay_config['input_charset']= strtolower('utf-8');

        //ca证书路径地址，用于curl中ssl校验
        //请保证cacert.pem文件在当前文件夹目录中
        $alipay_config['cacert']    = $this->container->get('kernel')->getRootDir().'/../vendor/mot/alipay/cacert.pem';

        //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
        $alipay_config['transport']    = 'http';

        //支付类型
        $payment_type = "1";
        //必填，不能修改
        //服务器异步通知页面路径
        $notify_url = "http://www.xxx.com/create_direct_pay_by_user-PHP-UTF-8/notify_url.php";
        //需http://格式的完整路径，不能加?id=123这类自定义参数

        //页面跳转同步通知页面路径
        $return_url = "http://www.xxx.com/create_direct_pay_by_user-PHP-UTF-8/return_url.php";
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

        //卖家支付宝帐户
        $seller_email = 'Mwang@36lean.com';
        //必填

        //商户订单号
        $out_trade_no = $order->getTradeId();
        //商户网站订单系统中唯一订单号，必填

        //订单名称
        $subject = '在线课程: '.$order->getLesson()->getName();
        //必填

        //付款金额
        $total_fee = $order->getPrice();
        //必填

        //订单描述

        $body = '购买在线课程 《'.$order->getLesson()->getName().'》';
        //商品展示地址
        $show_url = $this->container->get('router')->generate('home_lesson', ['id'=>$order->getLessonId()] , UrlGeneratorInterface::ABSOLUTE_URL);
        //需以http://开头的完整路径，例如：http://www.xxx.com/myorder.html

        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数

        //客户端的IP地址
        $exter_invoke_ip = $this->container->get('request')->getClientIp();;
        //非局域网的外网IP地址，如：221.0.0.1


        /************************************************************/

        //构造要请求的参数数组，无需改动
        $parameter = array(
            "service" => "create_direct_pay_by_user",
            "partner" => trim($alipay_config['partner']),
            "payment_type"	=> $payment_type,
            "notify_url"	=> $notify_url,
            "return_url"	=> $return_url,
            "seller_email"	=> $seller_email,
            "out_trade_no"	=> $out_trade_no,
            "subject"	=> $subject,
            "total_fee"	=> $total_fee,
            "body"	=> $body,
            "show_url"	=> $show_url,
            "anti_phishing_key"	=> $anti_phishing_key,
            "exter_invoke_ip"	=> $exter_invoke_ip,
            "_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
        );

        //建立请求
        $alipaySubmit = new \AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "跳转到支付宝付款");
        echo $html_text;

    }

    protected function getParams()
    {
        return $this->container->get('alipay.entity')->findOneBy(['isDefault'=>true]);
    }

    public function finishPayment()
    {
        // TODO: Implement finishPayment() method.
    }


}