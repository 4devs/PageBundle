<?php

namespace FDevs\PageBundle\Model;

use Doctrine\Common\Collections\Collection;
use FDevs\Locale\Model\LocaleText;

trait PageTrait
{
    /**
     * @var LocaleText[]
     */
    protected $title;

    /**
     * @param array|Collection|LocaleText[] $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return array|Collection|LocaleText[]
     */
    public function getTitle()
    {
        return $this->title;
    }
}
