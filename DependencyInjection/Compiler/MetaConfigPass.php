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
        if ($container->hasDefinition('f_devs_page.meta.registry')) {
            $metaConfigs = $container->findTaggedServiceIds('f_devs_page.meta.config');
            $metaExt = $container->getDefinition('f_devs_page.meta.registry');
            foreach ($metaConfigs as $id => $tags) {

                foreach ($tags as $tag) {
                    $name = isset($tag['name']) ? $tag['name'] : substr(stristr($id, '.'), 1);
                    $metaExt->addMethodCall('set', [$name, new Reference($id)]);
                }
            }
        }
    }
}
