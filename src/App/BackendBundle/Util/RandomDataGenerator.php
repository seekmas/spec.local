<?php

namespace App\BackendBundle\Util;

class RandomDataGenerator
{
    public static  function getOrderId()
    {
        return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }

}