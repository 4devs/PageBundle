<?php

namespace FDevs\PageBundle\Twig;

use FDevs\PageBundle\Model\OpenGraphInterface;

class OpenGraphExtension extends \Twig_Extension
{
    /** @var array */
    private $default = ['author' => '@author'];

    /** @var array */
    private $propertyFields = [];

    /** @var array */
    private $propertyNamespace = [];

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

    public function ogPrefixFunction($prefix = '')
    {
        $data = '';
        if ($prefix && isset($this->propertyNamespace[$prefix])) {
            $data = ' prefix="' . $prefix . ': ' . $this->propertyNamespace[$prefix] . '"';
        } elseif (!$prefix && count($this->propertyNamespace)) {
            $data = 'prefix="';
            foreach ($this->propertyNamespace as $prefix => $namespace) {
                $data .= $prefix . ': ' . $namespace . ' ';
            }
            $data = ' ' . trim($data) . '"';
        }


        return $data;
    }

    public function ogFunction(\Twig_Environment $env, OpenGraphInterface $og, array $default = [])
    {
        if (!$env->hasExtension('string_loader')) {
            $ext = $env->getExtensions();
            $ext['string_loader'] = new \Twig_Extension_StringLoader();
            $env = new \Twig_Environment($env->getLoader());
            $env->setExtensions($ext);
        }

        return $env->render(
            'FDevsPageBundle:OpenGraph:meta.html.twig',
            ['data' => $og, 'fields' => $this->propertyFields, 'options' => array_merge($this->default, $default)]
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
     * @param array $propertyFields
     *
     * @return self
     */
    public function setPropertyFields($propertyFields)
    {
        $this->propertyFields = $propertyFields;

        return $this;
    }

    /**
     * @param array $propertyNamespace
     *
     * @return self
     */
    public function setPropertyNamespace($propertyNamespace)
    {
        $this->propertyNamespace = $propertyNamespace;

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
