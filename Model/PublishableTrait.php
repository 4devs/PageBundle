<?php

namespace FDevs\PageBundle\Model;

trait PublishableTrait
{
    /**
     * @var boolean
     */
    protected $publishable;

    /**
     * {@inheritDoc}
     */
    public function isPublishable()
    {
        return $this->publishable;
    }

    /**
     * {@inheritDoc}
     */
    public function setPublishable($publishable)
    {
        $this->publishable = (boolean) $publishable;

        return $this;
    }

}
