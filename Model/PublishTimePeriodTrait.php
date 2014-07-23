<?php

namespace FDevs\PageBundle\Model;

trait PublishTimePeriodTrait
{
    /**
     * @var \DateTime
     */
    protected $publishStartDate;

    /**
     * @var \DateTime
     */
    protected $publishEndDate;

    /**
     * {@inheritDoc}
     */
    public function setPublishStartDate(\DateTime $publishDate = null)
    {
        $this->publishStartDate = $publishDate;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setPublishEndDate(\DateTime $publishDate = null)
    {
        $this->publishStartDate = $publishDate;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getPublishStartDate()
    {
        return $this->publishStartDate;
    }

    /**
     * {@inheritDoc}
     */
    public function getPublishEndDate()
    {
        return $this->publishEndDate;
    }

}
