<?php

namespace FDevs\PageBundle\Twig;

use FDevs\PageBundle\Model\OpenGraphInterface;

class OpenGraphExtension extends \Twig_Extension
{
    /** @var array */
    private $default = ['author' => '@author'];

    /** @var array */
    private $propertyList = [];

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'og',
                array($this, 'ogFunction'),
                array('is_safe' => array('html'), 'needs_environment' => true)
            ),
            new \Twig_SimpleFunction(
                'og_prefix',
                array($this, 'ogPrefixFunction'),
                array('is_safe' => array('html'))
            ),
        ];
    }

    public function ogPrefixFunction(OpenGraphInterface $og = null)
    {
        $type = '';
        if ($og) {
            $type = '/' . $og->getObjectType();
            if (strpos($type, '.')) {
                $type = strstr($type, '.', true);
            }
        }

        return 'prefix="og: http://ogp.me/ns' . $type . '#"';
    }

    public function ogFunction(\Twig_Environment $env, OpenGraphInterface $og, array $default = [])
    {
        return $env->render(
            'FDevsPageBundle:OpenGraph:meta.html.twig',
            ['data' => $og, 'fields' => $this->propertyList, 'options' => array_merge($this->default, $default)]
        );
    }

    /**
     * @param array $default
     *
     * @return self
     */
    public function setDefault($default)
    {
        $this->default = $default;

        return $this;
    }

    /**
     * @param array $propertyList
     *
     * @return self
     */
    public function setPropertyList($propertyList)
    {
        $this->propertyList = $propertyList;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'open_graph_extension';
    }

}
