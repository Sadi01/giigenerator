<?php
/**
 * This is the template for generating the ActiveQuery class.
 */
use sadi01\giigenerator\generators\model\Generator;
use yii\web\View;

/** @var View $this */
/** @var Generator $generator */
/** @var string $tableName full table name */
/** @var string $className class name */
/** @var yii\db\TableSchema $tableSchema */
/** @var string[] $labels list of attribute labels (name => label) */
/** @var string[] $rules list of validation rules */
/** @var array $relations list of relations (name => relation declaration) */
/** @var string $className class name */
/** @var string $modelClassName related model class name */

$modelFullClassName = $modelClassName;
if ($generator->ns !== $generator->queryNs) {
    $modelFullClassName = '\\' . $generator->ns . '\\' . $modelFullClassName;
}

echo "<?php\n";
?>

namespace <?= $generator->queryNs ?>;

/**
* This is the ActiveQuery class for [[<?= $modelFullClassName ?>]].
*
* @see <?= $modelFullClassName . "\n" ?>
*/
class <?= $className ?> extends <?= '\\' . ltrim($generator->queryBaseClass, '\\') . "\n" ?>
{
<?php if($generator->generateItemAlias): ?>
    public function active()
    {
    return $this->onCondition('<>', <?php echo $modelFullClassName ?>::tableName() . '.status', <?php echo $modelFullClassName ?>::STATUS_DELETE);
    }
<?php endif; ?>

/**
* {@inheritdoc}
* @return <?= $modelFullClassName ?>[]|array
*/
public function all($db = null)
{
return parent::all($db);
}

/**
* {@inheritdoc}
* @return <?= $modelFullClassName ?>|array|null
*/
public function one($db = null)
{
return parent::one($db);
}
}