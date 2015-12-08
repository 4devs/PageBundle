<?php

namespace FDevs\PageBundle\Sonata\Extension;

use Sonata\AdminBundle\Admin\AdminExtension;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PageExtension extends AdminExtension
{
    /**
     * {@inheritdoc}
     */
    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('form.group_general', array('translation_domain' => 'FDevsPageBundle'))
                ->add('page', 'f_devs_page', array('required' => true, 'label' => false))
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title');
    }
}
