<?php
/**
 * This is the template for generating a controller class file.
 */

use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use yii\web\View;
use  yii\gii\generators\controller\Generator;

/** @var View $this */
/** @var Generator $generator */

echo "<?php\n";
?>

namespace <?= $generator->getControllerNamespace() ?>;
<?php if($generator->checkAccessControl): ?>
use yii\filters\AccessControl;
<?php endif; ?>

class <?= StringHelper::basename($generator->controllerClass) ?> extends <?= '\\' . trim($generator->baseClass, '\\') . "\n" ?>
{
<?php if($generator->checkAccessControl): ?>
/**
* @inheritDoc
*/
public function behaviors()
{
    return array_merge(
        parent::behaviors(),
        [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => [
                            'index', 'view', 'create', 'update', 'delete'
                        ],
                        'roles' => [
                            '@'
                        ],
                        'allow' => true,
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['GET', 'HEAD'],
                ],
            ],
        ]
    );
}
<?php endif; ?>

<?php foreach ($generator->getActionIDs() as $action): ?>
    public function action<?= Inflector::id2camel($action) ?>()
    {
        return $this->render('<?= $action ?>');
    }

<?php endforeach; ?>
}