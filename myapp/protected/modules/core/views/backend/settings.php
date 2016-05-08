<?php
$this->breadcrumbs = [
    Yii::t('CoreModule.core', 'Websum') => ['settings'],
    Yii::t('CoreModule.core', 'Modules'),
];
?>

<h1><?php echo Yii::t('CoreModule.core', 'Modules'); ?></h1>

<?php echo Yii::t(
    'CoreModule.core',
    'Setup modules "{app}" for your needs',
    ['{app}' => CHtml::encode(Yii::app()->name)]
); ?>

<br/><br/>
<div class="alert alert-warning">
    <p>
        <?php
        $coreCount = count($modules);
        $enableCount = 0;
        foreach ($modules as $module) {
            if ('install' === $module->id) {
                $enableCount--;
                $coreCount--;
            }
            if ($module instanceof core\components\WebModule && ($module->getIsActive() || $module->getIsNoDisable())) {
                $enableCount++;
            }
        }
        ?>
        <?php echo Yii::t('CoreModule.core', 'Installed'); ?>
        <small class="label label-info"><?php echo $coreCount; ?></small>
        <?php echo Yii::t('CoreModule.core', 'module|module|modules', $coreCount); ?>,
        <?php echo Yii::t('CoreModule.core', 'enabled'); ?>
        <small class="label label-info"><?php echo $enableCount; ?></small>
        <?php echo Yii::t('CoreModule.core', 'module|module|modules', $enableCount); ?>,
        <?php echo Yii::t('CoreModule.core', 'disabled|disabled', $coreCount - $enableCount); ?>
        <small class="label label-info"><?php echo $coreCount - $enableCount; ?></small>
        <?php echo Yii::t('CoreModule.core', 'module|module|modules', $coreCount - $enableCount); ?>
        
    </p>
</div>

<?php echo $this->renderPartial('_moduleslist', ['modules' => $modules]); ?>
