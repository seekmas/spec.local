<?php

namespace App\FrontendBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class MenuBuilder
{

    private $factory;
    private $container;
    public function __construct(FactoryInterface $factory , $container)
    {
        $this->factory = $factory;
        $this->container = $container;
    }

    public function createMainMenu(Request $request)
    {
        $translator = $this->container->get('translator');

        $menu = $this->factory->createItem('root');

        //$menu->addChild('home',['attributes' =>['icon'=>'fa fa-home'],'label' => '首页','route' => '']);
        $menu->addChild('lesson',['attributes' =>['icon'=>'fa fa-university'],'label' => $translator->trans('layout.lesson'),'route' => 'home_page']);
        $menu->addChild('forum',['attributes' =>['icon'=>'fa fa-at'],'label' => $translator->trans('layout.forum'),'route' => 'forum']);

//        $menu->addChild('training',['attributes' =>['icon'=>'fa fa-home'],'label' => '培训','route' => '']);
//        $menu->addChild('arrangement',['attributes' =>['icon'=>'fa fa-home'],'label' => '活动','route' => 'home_calender']);
//        $menu->addChild('consulting',['attributes' =>['icon'=>'fa fa-home'],'label' => '顾问咨询','route' => '']);

        return $menu;
    }
}