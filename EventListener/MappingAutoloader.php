<?php

namespace FDevs\PageBundle\EventListener;

use Doctrine\ODM\MongoDB\Event\LoadClassMetadataEventArgs;

class MappingAutoloader
{
    /** @var string */
    private $interface = '';
    /** @var string */
    private $fields = [];

    /**
     * init
     *
     * @param string $interface
     * @param array  $fields
     */
    public function __construct($interface, array $fields)
    {
        $this->fields = $fields;
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
        foreach ($this->fields as $field) {
            $classMetadata->mapField($field);
        }
    }
}
