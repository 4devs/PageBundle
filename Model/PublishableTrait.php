<?php

namespace FDevs\PageBundle\Model;

trait PublishableTrait
{
    /**
     * @var bool
     */
    protected $publishable;

    /**
     * {@inheritdoc}
     */
    public function isPublishable()
    {
        return $this->publishable;
    }

    /**
     * {@inheritdoc}
     */
    public function setPublishable($publishable)
    {
        $this->publishable = (boolean) $publishable;

        return $this;
    }
}
