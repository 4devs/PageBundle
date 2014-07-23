<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 1/4/14
 * Time: 9:13 PM
 */

namespace FDevs\PageBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MetaType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'keywords',
                'translatable',
                array('label' => 'form.keywords', 'type' => 'text', 'translation_domain' => 'FDevsPageBundle')
            )
            ->add(
                'metaDescription',
                'translatable',
                array('label' => 'form.metaDescription', 'type' => 'textarea', 'translation_domain' => 'FDevsPageBundle')
            );
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'inherit_data' => true,
                'translation_domain' => 'FDevsPageBundle'
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'f_devs_meta';
    }
}
