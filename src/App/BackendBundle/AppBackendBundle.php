<?php
namespace App\BackendBundle;

use App\BackendBundle\DependencyInjection\CompilePass\FormTwigPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppBackendBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass( new FormTwigPass());
    }
}
