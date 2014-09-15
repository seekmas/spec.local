<?php

namespace App\FrontendBundle;

use App\FrontendBundle\DependencyInjection\CompilePass\KnpMenuPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppFrontendBundle extends Bundle
{
    public function build( ContainerBuilder $container)
    {
        $container->addCompilerPass( new KnpMenuPass());
    }
}
