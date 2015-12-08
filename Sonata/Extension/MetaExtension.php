<?php

namespace FDevs\PageBundle\Sonata\Extension;

use Sonata\AdminBundle\Admin\AdminExtension;
use Sonata\AdminBundle\Form\FormMapper;

class MetaExtension extends AdminExtension
{
    /**
     * {@inheritdoc}
     */
    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('form.group_meta', ['translation_domain' => 'FDevsPageBundle'])
                ->add('meta_data', 'fdevs_meta', ['required' => false, 'label' => false])
            ->end();
    }
}
