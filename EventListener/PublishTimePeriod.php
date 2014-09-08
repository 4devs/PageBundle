<?php

namespace FDevs\PageBundle\EventListener;

use Doctrine\Common\Persistence\Event\LoadClassMetadataEventArgs;

class PublishTimePeriod
{
    const INTERFACE_PUBLISH_TIME_PERIOD = 'Symfony\Cmf\Bundle\CoreBundle\PublishWorkflow\PublishTimePeriodInterface';

    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        $metadata = $eventArgs->getClassMetadata();
        if (!in_array(self::INTERFACE_PUBLISH_TIME_PERIOD, class_implements($metadata->getName()))) {
            return;
        }
        $classMetadata = $eventArgs->getClassMetadata();
        $meta = $eventArgs->getObjectManager()->getClassMetadata('FDevs\PageBundle\Model\PublishTimePeriod');
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
