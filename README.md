Admin LTE 4 Yii2 tmp
====================
Admin LTE template 4 Yii2 fw

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist shrouds/yii2-admin-lte "*"
```

or add

```
"shrouds/yii2-admin-lte": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your config by  :

```php
'components' => [
  'view' => [
            'theme' => [
                'class' => \shrouds\admin\AdminTheme::className()
            ]
        ]
]
```
