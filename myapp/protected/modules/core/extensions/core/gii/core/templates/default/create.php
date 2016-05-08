<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 *
 * @category CoreGiiTemplate
 * @package  core
 * @author   Core Team <team@websum.uz>
 * @license  https://github.com/core/core/blob/master/LICENSE BSD
 * @link     http://websum.uz
 */
?>
<?php
$nameColumn = $this->guessNameColumn($this->tableSchema->columns);
$label = $this->mb_ucfirst($this->mim);

echo <<<EOF
<?php
/**
 * Отображение для create:
 *
 *   @category CoreView
 *   @package  core
 *   @author   Core Team <team@websum.uz>
 *   @license  https://github.com/core/core/blob/master/LICENSE BSD
 *   @link     http://websum.uz
 **/
    \$this->breadcrumbs = array(
        Yii::app()->getModule('{$this->mid}')->getCategory() => array(),
        Yii::t('{$this->mid}', '{$label}') => array('/{$this->mid}/{$this->controller}/index'),
        Yii::t('{$this->mid}', 'Добавление'),
    );

    \$this->pageTitle = Yii::t('{$this->mid}', '{$label} - добавление');

    \$this->menu = array(
        array('icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('{$this->mid}', 'Управление {$this->mtvor}'), 'url' => array('/{$this->mid}/{$this->controller}/index')),
        array('icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('{$this->mid}', 'Добавить {$this->vin}'), 'url' => array('/{$this->mid}/{$this->controller}/create')),
    );
?>
EOF;
?>

<div class="page-header">
    <h1>
        <?php echo "<?php echo Yii::t('{$this->mid}', '{$label}'); ?>\n"; ?>
        <small><?php echo "<?php echo Yii::t('{$this->mid}', 'добавление'); ?>"; ?></small>
    </h1>
</div>

<?php echo "<?php echo \$this->renderPartial('_form', array('model' => \$model)); ?>"; ?>
