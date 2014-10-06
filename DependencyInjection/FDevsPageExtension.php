<?php

namespace FDevs\PageBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class FDevsPageExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter($this->getAlias() . '.allowed_locales', $config['allowed_locales']);
        $container->setParameter($this->getAlias() . '.manager_name', $config['manager_name']);
        $container->setParameter($this->getAlias() . '.backend_type_' . $config['db_driver'], true);
        array_walk(
            $config['open_graph']['property'],
            function (&$val) {
                $val = $val['fields'];
            }
        );
        $container->setParameter($this->getAlias() . '.open_graph.property', $config['open_graph']['property']);
        $container->setParameter($this->getAlias() . '.open_graph.default', $config['open_graph']['default']);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');
        $loader->load('form.xml');
        $loader->load('admin-extension.xml');
        $loader->load($config['db_driver'] . '.xml');
    }
}
