Getting Started With PageBundle
===========================================

## Installation and usage

Installation and usage is a quick:

1. Download PageBundle using composer
2. Enable the Bundle
3. Use the bundle
4. Use with [SonataAdminBundle](https://github.com/sonata-project/SonataAdminBundle)
5. Use Meta Data


### Step 1: Download PageBundle using composer

Tell composer to download the bundle by running the command:

``` bash
$ php composer.phar require fdevs/page-bundle
```

Composer will install the bundle to your project's `vendor/fdevs` directory.


### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new FDevs\LocaleBundle\FDevsLocaleBundle(),
        new FDevs\PageBundle\FDevsPageBundle(),
    );
}
```

add config
``` yml
# app/config/config.yml
f_devs_locale:
    allowed_locales: ['ru','en']
```

### Step 3: Use the bundle

add field in your model

``` xml
<document name="DemoBundle\Model\Document">
    <!--...-->
    <embed-many target-document="FDevs\Locale\Model\LocaleText" field="text" fieldName="text"/>
</document>
```

use in form

``` php
//src/DemoBundle/Form/Type/DemoType.php
class DemoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('text', 'trans_textarea', ['type' => 'ckeditor'])
    }
}
```

### Step 4: Use with SonataAdminBundle

add config

``` yml
# app/config/config.yml
f_devs_page:
    admin_driver: 'sonata'
    
sonata_admin:
    extensions:
        f_devs_page.admin_extension.page:
            implements:
                - FDevs\PageBundle\Model\PageInterface
        f_devs_page.admin_extension.meta:
            implements:
                - FDevs\MetaPage\MetaInterface
```

### Step 5: Use Meta Data

add config
* if there is a `variable` taken its value 
* if there is `form_type` that can be edited in the `sonata`
* `form_type` must be compatible with `\FDevs\Locale\Form\Type\TransType` type
* `filters` should be available in `twig`

``` yml
# app/config/config.yml
f_devs_page:
    admin_driver: "sonata"
    head:
        prefix: 'prefix="og: http://ogp.me/ns# video: http://ogp.me/ns/video# ya: http://webmaster.yandex.ru/vocabularies/"'
    metas:
        description:
            type: 'name'
            name: 'description'
            content: "4devs company"
            form_type: "trans_textarea"
            filters: "title|trans({},'AppBundle')"
        og_title:
            type: 'property'
            variable: "title"
            name: 'og:title'
            content: "4devs company"
            variable: "title"
        og_type:
            type: 'property'
            name: 'og:type'
            content: "website"
```

use in template

```twig
<html {{ head_attributes() }}>

{{ meta() }}
{#<meta name="description" content="4Devs Company"/><meta property="og:title" content="4devs company"/><meta property="og:type" content="website"/>#}

{#or#}
{{ meta(page) }}
{#<meta name="description" content="page desription"/><meta property="og:title" content="page title"/><meta property="og:type" content="website"/>#}
```
