<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use yii\web\View;
use sadi01\giigenerator\generators\crud\Generator;

/** @var View $this */
/** @var Generator $generator */

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\web\View;
use <?= ltrim($generator->modelClass, '\\') ?>;

/** @var View $this */
/** @var <?= ltrim($generator->searchModelClass, '\\') ?> $model */
/** @var ActiveForm $form */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-search">

    <?= "<?php " ?>$form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
<?php if ($generator->enablePjax): ?>
        'options' => [
            'data-pjax' => 1
        ],
<?php endif; ?>
    ]); ?>

<?php
$count = 0;
foreach ($generator->getColumnNames() as $attribute) {
    if (++$count < 6) {
        echo "    <?= " . $generator->generateActiveSearchField($attribute) . " ?>\n\n";
    } else {
        echo "    <?php // echo " . $generator->generateActiveSearchField($attribute) . " ?>\n\n";
    }
}
?>
    <div class="form-group">
        <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('Search') ?>, ['class' => 'btn btn-primary']) ?>
        <?= "<?= " ?>Html::resetButton(<?= $generator->generateString('Reset') ?>, ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?= "<?php " ?>ActiveForm::end(); ?>

</div>