<?php

namespace FDevs\PageBundle\Service;

use Doctrine\Common\Collections\Collection;
use FDevs\PageBundle\Model\LocaleTextInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ChoiceText
{

    /** @var  string */
    private $locale;
    /** @var ContainerInterface */
    private $container;

    /**
     * set Container
     *
     * @param ContainerInterface $container
     *
     * @return $this
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;

        return $this;
    }

    /**
     * set Locale
     *
     * @param string $locale
     *
     * @return $this
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * get Locale
     *
     * @param string $locale
     *
     * @return string
     */
    public function getLocale($locale = '')
    {
        if (null === $this->locale
            && $this->container->isScopeActive('request')
            && $this->container->has('request')
        ) {
            $this->locale = $this->container->get('request')->getLocale();
        }

        return $locale ?: $this->locale;
    }

    /**
     * @param array|Collection $data
     * @param string           $locale
     *
     * @return string
     */
    public function getText($data, $locale = '')
    {
        $result = '';
        $locale = $this->getLocale($locale);
        if ($data instanceof Collection) {
            $result = $this->getTextByCollection($data, $locale);
        } elseif (is_array($data)) {
            $result = $this->getTextByArray($data, $locale);
        }

        return $result;
    }

    /**
     * get Text By Collection
     *
     * @param Collection $data
     * @param string     $locale
     *
     * @return string
     */
    public function getTextByCollection(Collection $data, $locale = '')
    {
        $result = '';
        $locale = $this->getLocale($locale);
        $text = $data->filter(
            function (LocaleTextInterface $var) use ($locale) {
                return $var->isLocale($locale);
            }
        );
        if (count($text)) {
            $result = $text->first()->getText();
        }

        return $result;

    }

    /**
     * get Text By Array
     *
     * @param array  $data
     * @param string $locale
     *
     * @return string
     */
    public function getTextByArray(array $data, $locale = '')
    {
        $result = '';
        $locale = $this->getLocale($locale);
        $text = array_filter(
            $data,
            function (LocaleTextInterface $var) use ($locale) {
                return $var->isLocale($locale);
            }
        );
        if (count($text)) {
            $result = reset($text)->getText();
        }

        return $result;
    }
}
