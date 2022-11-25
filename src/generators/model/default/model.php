<?php
/**
 * This is the template for generating the model class of a specified table.
 */
use sadi01\giigenerator\generators\model\Generator;
use yii\web\View;

/** @var View $this */
/** @var Generator $generator */
/** @var string $tableName full table name */
/** @var string $className class name */
/** @var string $queryClassName query class name */
/** @var yii\db\TableSchema $tableSchema */
/** @var array $properties list of properties (property => [type, name. comment]) */
/** @var string[] $labels list of attribute labels (name => label) */
/** @var string[] $rules list of validation rules */
/** @var array $relations list of relations (name => relation declaration) */

echo "<?php\n";
?>

namespace <?= $generator->ns ?>;

use Yii;
<?php if($generator->generateTimestampBehavior): ?>
    use yii\behaviors\TimestampBehavior;
<?php endif; ?>
<?php if($generator->generateBlameableBehavior): ?>
    use yii\behaviors\BlameableBehavior;
<?php endif; ?>
<?php if($generator->generateSoftDeleteBehavior): ?>
    use yii2tech\ar\softdelete\SoftDeleteBehavior;
<?php endif; ?>
<?php if($generator->generateJsonableBehavior): ?>
    use common\behaviors\Jsonable;
<?php endif; ?>
<?php if($generator->generateCdnUploadImageBehavior): ?>
    use common\behaviors\CdnUploadImageBehavior;
<?php endif; ?>

/**
* This is the model class for table "<?= $generator->generateTableName($tableName) ?>".
*
<?php foreach ($properties as $property => $data): ?>
    * @property <?= "{$data['type']} \${$property}"  . ($data['comment'] ? ' ' . strtr($data['comment'], ["\n" => ' ']) : '') . "\n" ?>
<?php endforeach; ?>
<?php if (!empty($relations)): ?>
    *
    <?php foreach ($relations as $name => $relation): ?>
        * @property <?= $relation[1] . ($relation[2] ? '[]' : '') . ' $' . lcfirst($name) . "\n" ?>
    <?php endforeach; ?>
<?php endif; ?>
*/
class <?= $className ?> extends <?= '\\' . ltrim($generator->baseClass, '\\') . "\n" ?>
{
<?php if($generator->generateItemAlias): ?>
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;
<?php endif; ?>

<?php if($generator->generateScenarios): ?>
    const SCENARIO_DELETE = 'delete';
<?php endif; ?>

/**
* {@inheritdoc}
*/
public static function tableName()
{
return '<?= $generator->generateTableName($tableName) ?>';
}
<?php if ($generator->db !== 'db'): ?>

    /**
    * @return \yii\db\Connection the database connection used by this AR class.
    */
    public static function getDb()
    {
    return Yii::$app->get('<?= $generator->db ?>');
    }
<?php endif; ?>

/**
* {@inheritdoc}
*/
public function rules()
{
return [<?= empty($rules) ? '' : ("\n            " . implode(",\n            ", $rules) . ",\n        ") ?>];
}

<?php if($generator->generateScenarios): ?>
    public function scenarios()
    {
    $scenarios = parent::scenarios();
    $scenarios[self::SCENARIO_DELETE] = ['!status'];

    return $scenarios;
    }
<?php endif; ?>

/**
* {@inheritdoc}
*/
public function attributeLabels()
{
return [
<?php foreach ($labels as $name => $label): ?>
    <?= "'$name' => " . $generator->generateString($label) . ",\n" ?>
<?php endforeach; ?>
];
}
<?php foreach ($relations as $name => $relation): ?>

    /**
    * Gets query for [[<?= $name ?>]].
    *
    * @return <?= $relationsClassHints[$name] . "\n" ?>
    */
    public function get<?= $name ?>()
    {
    <?= $relation[0] . "\n" ?>
    }
<?php endforeach; ?>
<?php if ($queryClassName): ?>
    <?php
    $queryClassFullName = ($generator->ns === $generator->queryNs) ? $queryClassName : '\\' . $generator->queryNs . '\\' . $queryClassName;
    echo "\n";
    ?>
    /**
    * {@inheritdoc}
    * @return <?= $queryClassFullName ?> the active query used by this AR class.
    */
    public static function find()
    {
    <?php if($generator->generateItemAlias): ?>
        $query = new <?= $queryClassFullName ?>(get_called_class());
        return $query->active();
    <?php else: ?>
        return new <?= $queryClassFullName ?>(get_called_class());
    <?php endif; ?>
    }
<?php endif; ?>

<?php if($generator->generateItemAlias): ?>
    public static function itemAlias($type, $code = NULL)
    {
    $_items = [
    'Status' => [
    self::STATUS_ACTIVE => Yii::t('app', 'Active'),
    self::STATUS_DELETED => Yii::t('app', 'Deleted')
    ],
    'StatusClass' => [
    self::STATUS_ACTIVE => 'success',
    self::STATUS_DELETED => 'danger'
    ],
    'StatusColor' => [
    self::STATUS_ACTIVE => '#23a665',
    self::STATUS_DELETED => '#ff5050',
    ],
    ];

    if (isset($code))
    return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
    else
    return isset($_items[$type]) ? $_items[$type] : false;
    }
<?php endif; ?>

<?php if(
    $generator->generateTimestampBehavior || $generator->generateCdnUploadImageBehavior || $generator->generateJsonableBehavior ||
    $generator->generateBlameableBehavior || $generator->generateSoftDeleteBehavior
) { ?>
    public function behaviors()
    {
    return array_merge(parent::behaviors, [
    <?php if($generator->generateTimestampBehavior): ?>
        'TimestampBehavior' => [
        'class' => TimestampBehavior::class,
        'createdAtAttribute' => 'created_at',
        'updatedAtAttribute' => 'updated_at',
        //'value' => new Expression('NOW()'),
        ],
    <?php endif; ?>
    <?php if($generator->generateBlameableBehavior): ?>
        'BlameableBehavior' => [
        'class' => BlameableBehavior::class,
        'createdByAttribute' => 'created_by',
        'updatedByAttribute' => 'updated_by'
        //'value' => Yii::$app->user->id,
        ],
    <?php endif; ?>
    <?php if($generator->generateJsonableBehavior): ?>
        'Jsonable' => [
        'class' => Jsonable::class,
        'jsonAttributes' => [
        'add_on' => [
        // Your json attributes
        ],
        ],
        ],
    <?php endif; ?>
    <?php if($generator->generateSoftDeleteBehavior): ?>
        'softDeleteBehavior' => [
        'class' => SoftDeleteBehavior::class,
        'softDeleteAttributeValues' => [
        'deleted_at' => time(),
        ],
        'restoreAttributeValues' => [
        'deleted_at' => null
        ],
        'replaceRegularDelete' => false, // mutate native `delete()` method
        'allowDeleteCallback' => function () {
        return false;
        },
        'invokeDeleteEvents' => true
        ],
    <?php endif; ?>
    <?php if($generator->generateCdnUploadImageBehavior): ?>
        'CdnUploadImageBehavior' => [
        'class' => CdnUploadImageBehavior::class,
        'attribute' => 'image',
        'scenarios' => [self::SCENARIO_DEFAULT],
        'instanceByName' => false,
        //'placeholder' => "/assets/images/default.jpg",
        'deleteBasePathOnDelete' => false,
        'createThumbsOnSave' => false,
        'transferToCDN' => true,
        'cdnPath' => "@cdnRoot/<?php echo $className; ?>/{id}",
        'basePath' => "@appRoot/temp-uploads/<?php echo $className; ?>/{id}",
        'path' => "@appRoot/temp-uploads/<?php echo $className; ?>/{id}",
        'url' => "@cdnWeb/<?php echo $className; ?>/{id}"
        ],
    <?php endif; ?>
    ]);
    }
<?php } ?>

<?php if($generator->generateFields): ?>
    public function fields()
    {
    $fields = [
    'id',
    ];

    return $fields;
    }
<?php endif; ?>

<?php if($generator->generateExtraFields): ?>
    public function extraFields()
    {
    $extraFields = [

    ];

    return $extraFields;
    }
<?php endif; ?>
}