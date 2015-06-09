<?php

namespace FDevs\PageBundle\Model;

use FDevs\Locale\Util\ChoiceText;
use FDevs\MetaPage\MetaInterface;
use FDevs\MetaPage\MetaTrait;

abstract class Page implements MetaInterface, PageInterface
{
    use MetaTrait;
    use PageTrait;
    use TimestampableTrait;

    /**
     * init
     */
    public function __construct()
    {
        $this->preUpdate();
    }

    /**
     * get Name
     *
     * @return string
     */
    public function __toString()
    {
        return ChoiceText::getFirstText($this->getTitle()) ?: 'New Page';
    }

    /**
     * preUpdate
     *
     * @return $this
     */
    public function preUpdate()
    {
        $this->updateTime();
    }
}
