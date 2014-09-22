<?php

namespace App\FrontendBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class MenuBuilder extends ContainerAware
{
    public function mainMenu( FactoryInterface $factory , array $options)
    {
        $menu = $factory->createItem('root');

        //home menu
        $menu->addChild('home',['attributes' =>['icon'=>'fa fa-home'],'label' => '首页','route' => '']);

        $menu->addChild('lesson',['attributes' =>['icon'=>'fa fa-home'],'label' => '课程','route' => 'home_page']);

//        $menu->addChild('training',['attributes' =>['icon'=>'fa fa-home'],'label' => '培训','route' => '']);

        $menu->addChild('forum',['attributes' =>['icon'=>'fa fa-home'],'label' => '社区','route' => 'forum']);

//        $menu->addChild('arrangement',['attributes' =>['icon'=>'fa fa-home'],'label' => '活动','route' => 'home_calender']);
//
//        $menu->addChild('consulting',['attributes' =>['icon'=>'fa fa-home'],'label' => '顾问咨询','route' => '']);

        return $menu;
    }
}