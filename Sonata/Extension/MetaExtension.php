<?php

namespace FDevs\PageBundle\Sonata\Extension;

use Sonata\AdminBundle\Admin\AdminExtension;
use Sonata\AdminBundle\Form\FormMapper;

class MetaExtension extends AdminExtension
{
    /**
     * {@inheritDoc}
     */
    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('form.group_meta', array('translation_domain' => 'FDevsPageBundle'))
                ->add('meta', 'f_devs_meta', array('required' => false, 'label' => false))
            ->end();
    }

}
