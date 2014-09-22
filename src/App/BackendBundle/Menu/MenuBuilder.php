<?php

namespace App\BackendBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class MenuBuilder extends ContainerAware
{
    public function mainMenu( FactoryInterface $factory , array $options)
    {
        $menu = $factory->createItem('root');

        //home menu
        $menu->addChild('home',['attributes' =>['icon'=>'fa fa-home'],'label' => '首页','route' => '']);
        $menu->addChild('lesson',['attributes' =>['icon'=>'fa fa-home'],'label' => '课程','route' => '']);
        $menu['lesson']->addChild('create_lesson',['attributes' =>['icon'=>'fa fa-home'],'label' => '课程 & 章节','route' => 'create_lesson']);
        $menu['lesson']->addChild('create_category',['attributes' =>['icon'=>'fa fa-home'],'label' => '课程分类','route' => 'create_category']);


        $menu->addChild('client',['attributes' =>['icon'=>'fa fa-home'],'label' => '客户','route' => '']);
        $menu['client']->addChild('user_manage',['attributes' =>['icon'=>'fa fa-home'],'label' => '用户管理','route' => 'user_manage']);
        $menu['client']->addChild('orders_manage',['attributes' =>['icon'=>'fa fa-home'],'label' => '订单管理','route' => 'orders_manage']);


        return $menu;
    }
}