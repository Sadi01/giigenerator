Yii2 Custom Gii Generators
===========================
Custom gii generators for Yii2 framework.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run console command

```
composer require sadi01/yii2-giigenerator "*"
```

Or add the package to the `require` section of your `composer.json` file:

```json
{
    "require": {
      "sadi01/yii2-giigenerator": "*"
    }
}
```

then run `composer update`.

Usage
-----

Once the extension is installed, simply use it in your config file :

```php
...
'modules' => [
'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1'],
            'generators' => [
                'crud' => [
                    'class' => 'sadi01\giigenerator\generators\crud\Generator',
                    'templates' => [
                        'SADiCRUD' => '@vendor/sadi01/yii2-giigenerator/src/generators/crud/default',
                        'default' => '@vendor/yiisoft/yii2-gii/src/generators/crud/default',
                    ],
                ],
                'form' => [
                    'class' => 'sadi01\giigenerator\generators\form\Generator',
                    'templates' => [
                        'SADiForm' => '@vendor/sadi01/yii2-giigenerator/src/generators/form/default',
                        'default' => '@vendor/yiisoft/yii2-gii/src/generators/form/default',
                    ],
                ],
                'controller' => [
                    'class' => 'sadi01\giigenerator\generators\controller\Generator',
                    'templates' => [
                        'SADiController' => '@vendor/sadi01/yii2-giigenerator/src/generators/controller/default',
                        'default' => '@vendor/yiisoft/yii2-gii/src/generators/controller/default',
                    ],
                ],
                'module' => [
                    'class' => 'sadi01\giigenerator\generators\module\Generator',
                    'templates' => [
                        'SADiModule' => '@vendor/sadi01/yii2-giigenerator/src/generators/module/default',
                        'default' => '@vendor/yiisoft/yii2-gii/src/generators/module/default',
                    ],
                ],
                'model' => [
                    'class' => 'sadi01\giigenerator\generators\model\Generator',
                    'templates' => [
                        'SADiModel' => '@vendor/sadi01/yii2-giigenerator/src/generators/model/default',
                        'default' => '@vendor/yiisoft/yii2-gii/src/generators/model/default',
                    ],
                ],
            ],
        ]
]
...

?>
```
