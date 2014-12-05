<?php

namespace App\BackendBundle\TwigExtension;

use JMS\DiExtraBundle\Annotation as DI;

class PageBoolExtension extends \Twig_Extension
{

    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('is_enabled', array($this, 'is_enabled')),
            new \Twig_SimpleFilter('is_done', array($this, 'is_done')),
        );
    }

    public function is_enabled($value)
    {
        $translator = $this->container->get('translator');
        return ( $value == true ? '<span class="label label-success">'.$translator->trans('user.enabled').'</span>' : '<span class="label label-danger">'.$translator->trans('user.disabled').'</span>');
    }

    public function is_done($value)
    {
        $translator = $this->container->get('translator');
        return ( $value == true ? '<span class="label label-success">'.$translator->trans('user.done').'</span>' : '<span class="label label-danger">'.$translator->trans('user.not_done').'</span>');
    }

    public function getName()
    {
        return 'page_bool_extension';
    }
}