<?php

namespace FDevs\PageBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FormPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $template = "FDevsPageBundle:Form:fields.html.twig";
        $resources = $container->getParameter('twig.form.resources');

        if (!in_array($template, $resources)) {
            $resources[] = "FDevsPageBundle:Form:fields.html.twig";
            $container->setParameter('twig.form.resources', $resources);
        }
    }
}
