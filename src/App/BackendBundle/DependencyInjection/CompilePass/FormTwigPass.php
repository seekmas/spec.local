<?php


namespace App\BackendBundle\DependencyInjection\CompilePass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FormTwigPass implements CompilerPassInterface
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
        $resources = $container->getParameter('twig.form.resources');
        $resources[] = 'AppBackendBundle:Form:form_div_layouts.html.twig';

        $container->setParameter('twig.form.resources' , $resources);
    }
}
