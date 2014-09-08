<?php

namespace FDevs\PageBundle\EventListener;

use Doctrine\Common\Persistence\Event\LoadClassMetadataEventArgs;

class Publishable
{
    const INTERFACE_PUBLISHABLE = 'Symfony\Cmf\Bundle\CoreBundle\PublishWorkflow\PublishableInterface';

    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        $metadata = $eventArgs->getClassMetadata();
        if (!in_array(self::INTERFACE_PUBLISHABLE, class_implements($metadata->getName()))) {
            return;
        }
        $classMetadata = $eventArgs->getClassMetadata();
        $meta = $eventArgs->getObjectManager()->getClassMetadata('FDevs\PageBundle\Model\Publishable');
        $fields = $meta->getFieldNames();
        foreach ($fields as $field) {
            $fieldMapping = [
                'fieldName' => $field,
                'name' => $field,
                'type' => $meta->getTypeOfField($field),
            ];
            $classMetadata->mapField($fieldMapping);
        }
    }
}
