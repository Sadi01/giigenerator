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
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-create card">
    <div class="card-header"><h3><?= "<?= " ?>Html::encode($this->title) ?></h3></div>
    <div class="card-body">
        <?= "<?= " ?>$this->render('_form', [
        'model' => $model,
        ]) ?>
    </div>
</div>