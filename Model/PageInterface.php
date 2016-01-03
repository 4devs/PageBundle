<?php

namespace FDevs\PageBundle\Model;

use FDevs\Locale\Model\LocaleText;
use Doctrine\Common\Collections\Collection;

interface PageInterface
{
    /**
     * @param array|Collection|LocaleText[] $title
     *
     * @return self
     */
    public function setTitle($title);

    /**
     * get Title.
     *
     * @return array|Collection|LocaleText[]
     */
    public function getTitle();
}
