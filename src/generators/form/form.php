<?php
use yii\web\View;
use yii\bootstrap4\ActiveForm;
use sadi01\giigenerator\generators\form\Generator;

/** @var View $this */
/** @var ActiveForm $form */
/** @var Generator $generator */

echo $form->field($generator, 'viewName');
echo $form->field($generator, 'modelClass');
echo $form->field($generator, 'scenarioName');
echo $form->field($generator, 'viewPath');
echo $form->field($generator, 'enableI18N')->checkbox();
echo $form->field($generator, 'messageCategory');