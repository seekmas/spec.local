<?php

namespace App\FrontendBundle\DependencyInjection\CompilePass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class KnpMenuPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        $knp_menu = $container->getParameter('knp_menu.renderer.twig.template');
        if( isset( $knp_menu ) )
        {
            $container->setParameter('knp_menu.renderer.twig.template' , 'AppFrontendBundle:Theme:knp_menu.html.twig');
        }
    }

}