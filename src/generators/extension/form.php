<?php
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap4\ActiveForm;
use sadi01\giigenerator\generators\extension\Generator;

/** @var View $this */
/** @var ActiveForm $form */
/** @var Generator $generator */

?>
<div class="alert alert-info">
    Please read the
    <?= Html::a('Extension Guidelines', 'http://www.yiiframework.com/doc-2.0/guide-structure-extensions.html', ['target'=>'new']) ?>
    before creating an extension.
</div>
<div class="module-form">
<?php
    echo $form->field($generator, 'vendorName');
    echo $form->field($generator, 'packageName');
    echo $form->field($generator, 'namespace');
    echo $form->field($generator, 'type')->dropDownList($generator->optsType());
    echo $form->field($generator, 'keywords');
    echo $form->field($generator, 'license')->dropDownList($generator->optsLicense(), ['prompt'=>'Choose...']);
    echo $form->field($generator, 'title');
    echo $form->field($generator, 'description');
    echo $form->field($generator, 'authorName');
    echo $form->field($generator, 'authorEmail');
    echo $form->field($generator, 'outputPath');
?>
</div>