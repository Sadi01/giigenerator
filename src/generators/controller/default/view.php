<?php
/**
 * This is the template for generating an action view file.
 */

use yii\web\View;
use sadi01\giigenerator\generators\controller\Generator;

/** @var View $this */
/** @var Generator $generator */
/** @var string $action the action ID */

echo "<?php\n";
?>
use yii\web\View;

/** @var View $this */
<?= "?>" ?>

<h1><?= $generator->getControllerSubPath() . $generator->getControllerID() . '/' . $action ?></h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= '<?=' ?> __FILE__; ?></code>.
</p>