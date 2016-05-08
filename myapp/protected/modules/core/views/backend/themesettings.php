<?php
$this->breadcrumbs = [
    Yii::t('CoreModule.core', 'System') => ['settings'],
    Yii::t('CoreModule.core', 'Themes'),
];
?>

<h1><?php echo Yii::t('CoreModule.core', 'Theme choise'); ?></h1>

<?php echo CHtml::beginForm(['/core/backend/themesettings', 'post'], 'post', ['class' => 'well']); ?>
<div class="form-group">
    <?php echo CHtml::label(Yii::t('CoreModule.core', 'Choose site theme'), 'theme'); ?>
    <div class="row">
        <div class="col-xs-5">
            <?php echo CHtml::dropDownList('theme', $theme, $themes, ['class' => 'form-control']); ?>
        </div>
    </div>
</div>
<div class="form-group">
    <?php echo CHtml::label(Yii::t('CoreModule.core', 'Choose backend theme'), 'backendTheme'); ?>
    <div class="row">
        <div class="col-xs-5">
            <?php echo CHtml::dropDownList(
                'backendTheme',
                $backendTheme,
                $backendThemes,
                ['class' => 'form-control', 'empty' => Yii::t('CoreModule.core', 'Theme is not using')]
            ); ?>
        </div>
    </div>
</div>
<br/><br/>
<?php echo CHtml::submitButton(
    Yii::t('CoreModule.core', 'Save themes settings'),
    ['class' => 'btn btn-primary']
); ?>

<?php echo CHtml::endForm(); ?>
