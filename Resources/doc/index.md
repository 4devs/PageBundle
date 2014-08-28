Getting Started With PageBundle
===========================================

## Installation and usage

Installation and usage is a quick:

1. Download PageBundle using composer
2. Enable the Bundle
3. Use the bundle


### Step 1: Download PageBundle using composer

Add PageBundle in your composer.json:

```js
{
    "require": {
        "fdevs/page-bundle": "*"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update fdevs/page-bundle
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
        new FDevs\PageBundle\FDevsPageBundle(),
    );
}
```

add config
``` yml
# app/config/config.yml
f_devs_page:
    allowed_locales: ['ru','en']
```

### Step 3: Use the bundle

add field in your model

``` xml
<document name="Acme\DemoBundle\Model\Document">
    <!--...-->
    <embed-many target-document="FDevs\PageBundle\Model\LocaleText" field="text" fieldName="text"/>
</document>
```

use in form

``` php
//src/Acme/DemoBundle/Form/Type/DemoType.php
class DemoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('text', 'translatable', ['type' => 'ckeditor'])
    }
}
```

