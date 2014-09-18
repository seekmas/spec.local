<?php

namespace App\BackendBundle\TwigExtension;

use JMS\DiExtraBundle\Annotation as DI;



class FormatExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('currency', array($this, 'currency')),
        );
    }

    public function currency($decimal)
    {
        return '<i class="fa fa-jpy"></i> '.$decimal;
    }

    public function getName()
    {
        return 'format_extension';
    }
}