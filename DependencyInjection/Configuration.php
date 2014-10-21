<?php

namespace FDevs\PageBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('f_devs_page');
        $supportedDrivers = ['mongodb'];

        $rootNode
            ->children()
                ->scalarNode('db_driver')
                    ->validate()
                        ->ifNotInArray($supportedDrivers)
                        ->thenInvalid('The driver %s is not supported. Please choose one of ' . json_encode($supportedDrivers))
                    ->end()
                    ->cannotBeOverwritten()
                    ->defaultValue('mongodb')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('manager_name')->defaultNull()->end()
                ->arrayNode('allowed_locales')
                    ->defaultValue(['en'])
                    ->prototype('scalar')->end()
                ->end()
                ->arrayNode('open_graph')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('property')
                            ->defaultValue([])
                            ->useAttributeAsKey('prefix')
                            ->prototype('array')
                                ->children()
                                    ->scalarNode('namespace')->end()
                                    ->arrayNode('fields')
                                    ->useAttributeAsKey('key')
                                        ->prototype('array')
                                            ->children()
                                                ->scalarNode('name')->isRequired()->end()
                                                ->scalarNode('filters')->defaultValue('')->end()
                                                ->scalarNode('function')->defaultValue('')->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('default')
                            ->useAttributeAsKey('key')
                            ->prototype('scalar')->isRequired()->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
