<?php

namespace FDevs\PageBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Intl\Intl;

class LocaleTextType extends AbstractType
{
    /**
     * @var string
     */
    private $fieldType = 'textarea';

    /**
     * init
     *
     * @param string $type
     */
    public function __construct($type = 'textarea')
    {
        $this->fieldType = $type;
    }

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $options['data_class'] = null;
        $options['compound'] = false;
        $options['property_path'] = null;
        $localeData = array();

        $options['label'] = Intl::getLanguageBundle()->getLanguageName($options['lang_code']);
        $localeData['data'] = $options['lang_code'];

        unset($options['lang_code']);
        $builder
            ->add('locale', 'hidden', $localeData)
            ->add('text', $this->fieldType, $options);
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setOptional(array('lang_code'))
            ->setRequired(array('lang_code'))
            ->setDefaults(
                array(
                    'compound' => true,
                    'data_class' => 'FDevs\PageBundle\Model\LocaleText',
                    'translation_domain' => 'FDevsPageBundle'
                )
            )
            ->addAllowedTypes(array('lang_code' => 'string'));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'locale_' . $this->fieldType;
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return $this->fieldType;
    }

}
