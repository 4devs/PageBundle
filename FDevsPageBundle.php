<?php

namespace FDevs\PageBundle;

use Doctrine\Bundle\MongoDBBundle\DependencyInjection\Compiler\DoctrineMongoDBMappingsPass;
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

        $container->addCompilerPass(
            DoctrineMongoDBMappingsPass::createXmlMappingDriver(
                array(
                    realpath(__DIR__ . '/Resources/config/doctrine/model') => 'FDevs\PageBundle\Model',
                ),
                array('f_devs_page.manager_name'),
                'f_devs_page.backend_type_mongodb'
            )
        );

    }

}
