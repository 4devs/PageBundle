<?php

namespace FDevs\PageBundle\DependencyInjection;

use FDevs\MetaPage\Model\MetaConfig;
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

        $container->setParameter($this->getAlias().'.manager_name', $config['manager_name']);
        $container->setParameter($this->getAlias().'.backend_type_'.$config['db_driver'], true);
        $container->setParameter($this->getAlias().'.head.config', $config['head']);

        $this->prepareMetaConfig($container, $config['metas']);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
        $loader->load('form.xml');
        $loader->load('twig_extensions.xml');

        if ($config['admin_driver'] !== 'none') {
            $loader->load(sprintf('admin/%s.xml', $config['admin_driver']));
        }
        if ($config['db_driver'] !== 'custom') {
            $loader->load($config['db_driver'].'.xml');
        }
    }

    /**
     * prepare meta config
     *
     * @param ContainerBuilder $container
     * @param array            $metaConfig
     */
    private function prepareMetaConfig(ContainerBuilder $container, $metaConfig)
    {
        $name = $this->getAlias().'.meta.%s';
        $tag = $this->getAlias().'.meta.config';
        foreach ($metaConfig as $key => $meta) {
            $metaConfig = $container
                ->register(sprintf($name, $key), 'FDevs\MetaPage\Model\MetaConfig')
                ->addArgument($meta['type'])
                ->addArgument($meta['name'])
                ->addArgument($meta['content'])
                ->addMethodCall('setRendered', [false])
                ->addMethodCall('setFilters', [$meta['filters']])
                ->addMethodCall('setContentType', [$meta['content_type']])
                ->addMethodCall('setVariable', [$meta['variable']])
                ->setPublic(false)
                ->addTag($tag, ['name' => $key])
            ;

            if ($meta['form_type'] && !$meta['variable']) {
                $metaConfig->addMethodCall('setFormType', [$meta['form_type']]);
            }
        }
    }
}
