<?php

namespace FDevs\PageBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class MetaConfigPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition('f_devs_page.twig_extension.meta')) {
            $metaConfigs = $container->findTaggedServiceIds('f_devs_page.meta.config');
            $metaExt = $container->getDefinition('f_devs_page.twig_extension.meta');
            foreach ($metaConfigs as $id => $meta) {
                $metaExt->addMethodCall('addConfig', [new Reference($id)]);
            }
        }
    }
}
