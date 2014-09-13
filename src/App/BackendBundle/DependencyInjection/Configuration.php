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
                    ->scalarNode('name')
                        ->defaultValue('App Backend Module')
                    ->end()
                    ->scalarNode('title')
                        ->defaultValue('App Backend Title')
                    ->end()
                    ->arrayNode('remote')
                        ->isRequired()
                        ->requiresAtLeastOneElement()
                        ->useAttributeAsKey('id')
                        ->prototype('array')
                            ->children()
                                ->scalarNode('prototype')->isRequired()->end()
                                ->scalarNode('description')->isRequired()->end()
                            ->end()
                        ->end()
                    ->end()
                  ->end()
        ;

        return $treeBuilder;
    }
}