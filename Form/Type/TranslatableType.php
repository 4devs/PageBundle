<?php

namespace FDevs\PageBundle\Form\Type;

use FDevs\PageBundle\Form\EventListener\TranslatableFormSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TranslatableType extends AbstractType
{
    /**
     * @var array
     */
    private $locales = array('en');

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'translatable';
    }

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $type = $options['type'];
        $options = $this->prepareOptions($options['options'], $options);
        $resizeListener = new TranslatableFormSubscriber($type, $options, $this->locales);

        $builder->addEventSubscriber($resizeListener);
    }

    /**
     * {@inheritDoc}
     */
    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        parent::finishView($view, $form, $options);
        $view->vars['type'] = $options['type'];
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setRequired(array('type'))
            ->setDefaults(
                array(
                    'type' => 'text',
                    'translation_domain' => 'FDevsPageBundle',
                    'options' => array(
                        'trim' => true,
                        'required' => true,
                        'read_only' => false,
                        'max_length' => null,
                        'pattern' => null,
                        'mapped' => true,
                        'by_reference' => true,
                        'label_attr' => array(),
                    ),
                )
            )
            ->addAllowedValues(array('type' => array('text', 'textarea', 'ckeditor')));
    }

    /**
     * set Locales
     *
     * @param array $locales
     *
     * @return $this
     */
    public function setLocales(array $locales)
    {
        $this->locales = $locales;

        return $this;
    }

    private function prepareOptions($options, $replace)
    {
        $data = [];
        foreach ($options as $key => $value) {
            $data[$key] = empty($replace[$key]) ? $value : $replace[$key];
        }

        return $data;
    }

}
