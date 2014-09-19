<?php

namespace App\BackendBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements  ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('app_backend');

        $rootNode->children()
                    ->scalarNode('notify_email')
                    ->end()
                    ->arrayNode('alipay')
                        ->children()
                            ->scalarNode('pid')->end()
                            ->scalarNode('key')->end()
                        ->end()
                ->end()
        ;


        return $treeBuilder;
    }
}