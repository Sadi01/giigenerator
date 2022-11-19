<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use sadi01\giigenerator\generators\crud\Generator;
use yii\web\View;
use yii\db\ActiveRecord;

/** @var View $this */
/** @var Generator $generator */
/* @var $model ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\web\View;
use <?= ltrim($generator->modelClass, '\\') ?>;

/** @var View $this */
/** @var <?= ltrim($generator->modelClass, '\\') ?> $model */
/** @var ActiveForm $form */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

    <?= "<?php " ?>$form = ActiveForm::begin(); ?>

<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes)) {
        echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
    }
} ?>
    <div class="form-group">
        <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('Save') ?>, ['class' => 'btn btn-success']) ?>
    </div>

    <?= "<?php " ?>ActiveForm::end(); ?>

</div>