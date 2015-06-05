<?php

namespace FDevs\PageBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PageType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'trans_text', ['label' => 'form.title']);
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['inherit_data' => true, 'translation_domain' => 'FDevsPageBundle']);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'f_devs_page';
    }
}
