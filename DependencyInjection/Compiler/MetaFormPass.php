<?php

namespace FDevs\PageBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class MetaFormPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition('f_devs_page.form.type.meta')) {
            $metaConfigs = $container->findTaggedServiceIds('f_devs_page.meta.form');
            $metaExt = $container->getDefinition('f_devs_page.form.type.meta');
            foreach ($metaConfigs as $id => $meta) {
                $metaExt->addMethodCall('addMetaConfig', [new Reference($id)]);
            }
        }
    }
}
