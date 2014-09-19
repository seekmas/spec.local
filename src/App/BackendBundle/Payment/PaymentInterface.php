<?php

namespace App\BackendBundle\Payment;

use App\BackendBundle\Entity\Lesson;
use App\BackendBundle\Entity\User;

interface PaymentInterface
{
    public function createOrder(Lesson $lesson , User $user);
    public function createPayment($orderId);
    public function orderIsExist(Lesson $lesson , User $user , $statusId);
    public function finishPayment($file);
}