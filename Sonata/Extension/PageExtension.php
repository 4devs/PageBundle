<?php

namespace FDevs\PageBundle\Sonata\Extension;

use FDevs\PageBundle\Form\Type\PageType;
use Sonata\AdminBundle\Admin\AbstractAdminExtension;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PageExtension extends AbstractAdminExtension
{
    /**
     * {@inheritdoc}
     */
    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('form.group_general', array('translation_domain' => 'FDevsPageBundle'))
                ->add('page', PageType::class, array('required' => true, 'label' => false))
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
