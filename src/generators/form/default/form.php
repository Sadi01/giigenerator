<?php
/**
 * This is the template for generating an action view file.
 */
use sadi01\giigenerator\generators\form\Generator;
use yii\web\View;

/** @var View $this */
/** @var Generator $generator */

$class = str_replace('/', '-', trim($generator->viewName, '_'));

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\web\View;
use <?= ltrim($generator->modelClass, '\\') ?>;

/** @var View $this */
/** @var <?= ltrim($generator->modelClass, '\\') ?> $model */
/** @var ActiveForm $form */
<?= "?>" ?>

<div class="<?= $class ?>">

    <?= "<?php " ?>$form = ActiveForm::begin(); ?>

    <?php foreach ($generator->getModelAttributes() as $attribute): ?>
    <?= "<?= " ?>$form->field($model, '<?= $attribute ?>') ?>
    <?php endforeach; ?>

        <div class="form-group">
            <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('Submit') ?>, ['class' => 'btn btn-primary']) ?>
        </div>
    <?= "<?php " ?>ActiveForm::end(); ?>

</div><!-- <?= $class ?> -->