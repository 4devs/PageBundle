<?php

namespace FDevs\PageBundle\Model;

interface MetaInterface
{
    /**
     * set Keywords
     *
     * @param LocaleText[]|array $keywords
     *
     * @return self
     */
    public function setKeywords(array $keywords);

    /**
     * get Keywords
     *
     * @return LocaleText[]
     */
    public function getKeywords();

    /**
     * set Meta Description
     *
     * @param  LocaleText[]|array $metaDescription
     *
     * @return self
     */
    public function setMetaDescription(array $metaDescription);

    /**
     * get Meta Description
     *
     * @return LocaleText
     */
    public function getMetaDescription();

    /**
     * get Author
     *
     * @return LocaleText
     */
    public function getMetaAuthor();

    /**
     * get Author
     *
     * @param LocaleText[]|array $author
     *
     * @return mixed
     */
    public function setMetaAuthor(array $author);
}
