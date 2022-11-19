<?php
use sadi01\giigenerator\generators\module\Generator;
use yii\web\View;
use yii\bootstrap4\ActiveForm;

/** @var View $this */
/** @var ActiveForm $form */
/** @var Generator $generator */

?>
<div class="module-form">
<?php
    echo $form->field($generator, 'moduleClass');
    echo $form->field($generator, 'moduleID');
?>
</div>