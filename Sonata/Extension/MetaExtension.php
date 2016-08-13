<?php

namespace FDevs\PageBundle\Sonata\Extension;

use FDevs\MetaPage\Form\Type\MetaType;
use Sonata\AdminBundle\Admin\AbstractAdminExtension;
use Sonata\AdminBundle\Form\FormMapper;

class MetaExtension extends AbstractAdminExtension
{
    /**
     * {@inheritdoc}
     */
    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('form.group_meta', ['translation_domain' => 'FDevsPageBundle'])
                ->add('meta_data', MetaType::class, ['required' => false, 'label' => false])
            ->end();
    }
}
