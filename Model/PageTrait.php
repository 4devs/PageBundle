<?php

namespace FDevs\PageBundle\Model;

trait PageTrait
{
    /**
     * @var LocaleText[]
     */
    protected $title;

    /**
     * @var LocaleText[]
     */
    protected $description;

    /**
     * @param LocaleText[] $description
     *
     * @return $this
     */
    public function setDescription(array $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return LocaleText[]
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param LocaleText[] $title
     *
     * @return $this
     */
    public function setTitle(array $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return LocaleText[]
     */
    public function getTitle()
    {
        return $this->title;
    }

}
