<?php

namespace FDevs\PageBundle\Service;

use Doctrine\Common\Collections\Collection;
use FDevs\PageBundle\Model\LocaleTextInterface;
use FDevs\PageBundle\Model\LocaleText;
use Symfony\Component\DependencyInjection\ContainerAware;

class ChoiceText extends ContainerAware
{

    /** @var  string */
    private $locale;

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
    public static function getText($data, $locale = '')
    {
        $result = '';
        if ($data instanceof Collection) {
            $result = self::getTextByCollection($data, $locale);
        } elseif (is_array($data)) {
            $result = self::getTextByArray($data, $locale);
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
    public static function getTextByCollection(Collection $data, $locale = '')
    {
        $result = '';
        $text = $data->filter(
            function (LocaleTextInterface $var) use ($locale) {
                return $var->isLocale($locale);
            }
        );
        if (count($text)) {
            $result = self::getFirstText($text);
        }

        return $result;

    }

    /**
     * get First Text
     *
     * @param Collection|array $data
     *
     * @return string
     */
    public static function getFirstText($data)
    {
        $locale = ['text' => ''];
        if ($data instanceof Collection) {
            $locale = $data->first();
        } elseif (is_array($data)) {
            $locale = reset($data);
        }

        return $locale instanceof LocaleText ? $locale->getText() : (is_array($locale) ? $locale['text'] : '');
    }

    /**
     * get Text By Array
     *
     * @param array  $data
     * @param string $locale
     *
     * @return string
     */
    public static function getTextByArray(array $data, $locale = '')
    {
        $result = '';
        $text = array_filter(
            $data,
            function (LocaleTextInterface $var) use ($locale) {
                return $var->isLocale($locale);
            }
        );
        if (count($text)) {
            $result = self::getFirstText($text);
        }

        return $result;
    }
}
