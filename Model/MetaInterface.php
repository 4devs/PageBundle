<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 1/4/14
 * Time: 9:29 PM
 */

namespace FDevs\PageBundle\Model;

interface MetaInterface
{
    /**
     * @param  array $keywords
     * @return self
     */
    public function setKeywords(array $keywords);

    /**
     * @return string
     */
    public function getKeywords();

    /**
     * @param  array $metaDescription
     * @return self
     */
    public function setMetaDescription(array $metaDescription);

    /**
     * @return string
     */
    public function getMetaDescription();
}
