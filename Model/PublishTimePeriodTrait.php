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
     * {@inheritdoc}
     */
    public function setPublishStartDate(\DateTime $publishDate = null)
    {
        $this->publishStartDate = $publishDate;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setPublishEndDate(\DateTime $publishDate = null)
    {
        $this->publishEndDate = $publishDate;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPublishStartDate()
    {
        return $this->publishStartDate;
    }

    /**
     * {@inheritdoc}
     */
    public function getPublishEndDate()
    {
        return $this->publishEndDate;
    }
}
