<?php
namespace FDevs\PageBundle\Model;

interface LocaleTextInterface
{
    /**
     * is Locale
     *
     * @param string $locale
     *
     * @return boolean
     */
    public function isLocale($locale);

    /**
     * get Text
     *
     * @return string
     */
    public function getText();
}
