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
        $supportedDrivers = ['mongodb', 'custom'];
        $metaType = ['name', 'property', 'http-equiv'];
        $supportedAdmins = ['sonata', 'none'];

        $rootNode
            ->children()
                ->enumNode('admin_driver')
                    ->values($supportedAdmins)
                    ->defaultValue('none')
                    ->cannotBeEmpty()
                ->end()
                ->enumNode('db_driver')
                    ->values($supportedDrivers)
                    ->cannotBeOverwritten()
                    ->defaultValue('mongodb')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('manager_name')->defaultNull()->end()
                ->arrayNode('metas')
                        ->prototype('array')
                            ->children()
                                ->enumNode('type')->values($metaType)->end()
                                ->scalarNode('name')->isRequired()->end()
                                ->scalarNode('content')->isRequired()->end()
                                ->scalarNode('variable')->defaultValue('')->end()
                                ->scalarNode('filters')->defaultValue('')->end()
                                ->scalarNode('form_type')->defaultValue('')->end()
                            ->end()
                    ->end()
                ->end()
                ->arrayNode('head')
                    ->useAttributeAsKey('key')
                    ->defaultValue([])
                    ->prototype('scalar')->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
