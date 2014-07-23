<?php

namespace FDevs\PageBundle\Model;

interface PageInterface
{
    /**
     * @param LocaleText[] $description
     *
     * @return self
     */
    public function setDescription(array $description);

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getDescription();

    /**
     * @param LocaleText[] $title
     *
     * @return self
     */
    public function setTitle(array $title);

    /**
     * get Title
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getTitle();
}
