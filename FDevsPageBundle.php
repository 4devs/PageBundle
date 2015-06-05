<?php

namespace FDevs\PageBundle;

use Doctrine\Bundle\MongoDBBundle\DependencyInjection\Compiler\DoctrineMongoDBMappingsPass;
use FDevs\PageBundle\DependencyInjection\Compiler\MetaConfigPass;
use FDevs\PageBundle\DependencyInjection\Compiler\MetaFormPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class FDevsPageBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $this->addRegisterMappingsPass($container);
        $container->addCompilerPass(new MetaConfigPass());
        $container->addCompilerPass(new MetaFormPass());
    }

    /**
     * @param ContainerBuilder $container
     */
    private function addRegisterMappingsPass(ContainerBuilder $container)
    {
        $meta = new \ReflectionClass('FDevs\MetaPage\MetaInterface');

        $mappings = [
            realpath(__DIR__.'/Resources/config/doctrine/model')                       => 'FDevs\PageBundle\Model',
            realpath(dirname($meta->getFileName()).'/Resources/config/doctrine/model') => 'FDevs\MetaPage\Model',
        ];

        if (class_exists('Doctrine\Bundle\MongoDBBundle\DependencyInjection\Compiler\DoctrineMongoDBMappingsPass')) {
            $container->addCompilerPass(
                DoctrineMongoDBMappingsPass::createXmlMappingDriver(
                    $mappings,
                    ['f_devs_page.manager_name'],
                    'f_devs_page.backend_type_mongodb'
                )
            );
        }
    }
}
