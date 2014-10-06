<?php

namespace FDevs\PageBundle\Model;

trait MetaTrait
{
    /** @var LocaleText[] */
    protected $keywords;

    /** @var LocaleText[] */
    protected $metaDescription;

    /** @var LocaleText[] */
    protected $metaAuthor;

    /**
     * @param LocaleText[] $keywords
     *
     * @return $this
     */
    public function setKeywords(array $keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * @return LocaleText[]
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param LocaleText[] $metaDescription
     *
     * @return $this
     */
    public function setMetaDescription(array $metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * @return LocaleText[]
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @return LocaleText[]
     */
    public function getMetaAuthor()
    {
        return $this->metaAuthor;
    }

    /**
     * @param LocaleText[] $author
     */
    public function setMetaAuthor(array $author)
    {
        $this->metaAuthor = $author;
    }
}
