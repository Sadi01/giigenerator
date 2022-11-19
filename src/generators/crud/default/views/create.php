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
use yii\web\View;
use <?= ltrim($generator->modelClass, '\\') ?>;

/** @var View $this */
/** @var <?= ltrim($generator->modelClass, '\\') ?> $model */

$this->title = <?= $generator->generateString('Create ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-create">

    <h1><?= "<?= " ?>Html::encode($this->title) ?></h1>

    <?= "<?= " ?>$this->render('_form', [
        'model' => $model,
    ]) ?>

</div>