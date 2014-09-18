<?php

namespace App\BackendBundle\TwigExtension;

use JMS\DiExtraBundle\Annotation as DI;



class PageBoolExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('is_enabled', array($this, 'is_enabled')),
        );
    }

    public function is_enabled($value)
    {
        return ( $value == true ? '<span class="label label-success">启用</span>' : '<span class="label label-danger">禁用</span>');
    }

    public function getName()
    {
        return 'page_bool_extension';
    }
}