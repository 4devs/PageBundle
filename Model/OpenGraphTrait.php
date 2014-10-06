<?php

namespace FDevs\PageBundle\Model;

use Doctrine\Common\Util\Inflector;

trait OpenGraphTrait
{
    /**
     * {@inheritDoc}
     */
    public function getObjectType()
    {
        return 'website';
    }

    public function getDataByName($name)
    {
        $data = '';
        $method = 'get' . Inflector::camelize($name);
        if (method_exists($this, $method)) {
            $data = $this->$method();
        }

        return $data;
    }

}
