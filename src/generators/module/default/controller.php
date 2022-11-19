<?php
/**
 * This is the template for generating a controller class within a module.
 */
use yii\web\View;
use sadi01\giigenerator\generators\module\Generator;

/** @var View $this */
/** @var Generator $generator */

echo "<?php\n";
?>

namespace <?= $generator->getControllerNamespace() ?>;

use yii\web\Controller;

/**
 * Default controller for the `<?= $generator->moduleID ?>` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}