<?php

namespace FDevs\PageBundle\EventListener;

use Doctrine\ODM\MongoDB\Event\LoadClassMetadataEventArgs;

class MappingAutoloader
{
    /** @var string */
    private $interface = '';
    /** @var string */
    private $classMetadata = '';

    /**
     * init
     *
     * @param string $classMetadata
     * @param string $interface
     */
    public function __construct($classMetadata, $interface)
    {
        $this->classMetadata = $classMetadata;
        $this->interface = $interface;
    }

    /**
     * add field by Interface
     *
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        $classMetadata = $eventArgs->getClassMetadata();
        if (!in_array($this->interface, class_implements($classMetadata->getName()))) {
            return;
        }
        $meta = $eventArgs->getObjectManager()->getClassMetadata($this->classMetadata);
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
