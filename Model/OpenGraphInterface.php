<?php

namespace FDevs\PageBundle\Model;


interface OpenGraphInterface extends MetaInterface, PageInterface
{
    /**
     * get Image
     *
     * @return string
     */
    public function getImage();

    /**
     * get Type
     *
     * @return string
     */
    public function getObjectType();

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function getDataByName($name);
}