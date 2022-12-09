<?php
use yii\web\View;
use yii\bootstrap4\ActiveForm;
use sadi01\giigenerator\generators\controller\Generator;
use yii\helpers\Html;

/** @var View $this */
/** @var ActiveForm $form */
/** @var Generator $generator */

echo $form->field($generator, 'controllerClass');
echo $form->field($generator, 'actions');
echo $form->field($generator, 'viewPath');
echo $form->field($generator, 'baseClass');
echo Html::tag('hr');
echo $form->field($generator, 'checkAccessControl')->checkbox();
