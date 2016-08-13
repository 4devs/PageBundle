<?php

namespace FDevs\PageBundle\Form\Type;

use FDevs\Locale\Form\Type\TransTextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TransTextType::class, ['label' => 'form.title']);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['inherit_data' => true, 'translation_domain' => 'FDevsPageBundle']);
    }
}
