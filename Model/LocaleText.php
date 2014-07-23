<?php

namespace FDevs\PageBundle\Model;

use Doctrine\Common\Inflector\Inflector;

class LocaleText implements LocaleTextInterface
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $locale;

    /**
     * init
     *
     * @param array $data
     */
    public function __construct(array $data = array())
    {
        foreach ($data as $key => $value) {
            $name = 'set' . Inflector::classify($key);
            if (method_exists($this, $name)) {
                $this->$name($value);
            }
        }
    }

    /**
     * to Array
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            'locale' => $this->locale,
            'text' => $this->text
        );
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->text;
    }

    /**
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
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     *
     * @return bool
     */
    public function isLocale($locale)
    {
        return $this->locale == $locale;
    }

    /**
     * @param string $text
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * {@inheritDoc}
     */
    public function __get($name)
    {
        return (string) $name;
    }

}
