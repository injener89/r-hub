<?php
$this->breadcrumbs = [
    Yii::t('CoreModule.core', 'Websum') => ['settings'],
    Yii::t('CoreModule.core', 'Help')
];
?>

<h1><?php echo Yii::t('CoreModule.core', 'About Websum'); ?></h1>

<p> <?php echo Yii::t('CoreModule.core', 'Any project must have About page. So it is here =)'); ?></p>

<br/>

<p>
    <?php echo Yii::t('CoreModule.core', 'You use Yii version'); ?>
    <small class="label label-info" title="<?php echo Yii::getVersion(); ?>"><?php echo Yii::getVersion(); ?></small>
    </br>
    <?php echo CHtml::encode(Yii::app()->name); ?>
    <?php echo Yii::t('CoreModule.core', 'version'); ?>
    <small class="label label-info"
           title="<?php echo $this->core->version; ?>"><?php echo $this->core->version; ?></small>
    </br>
    <?php echo Yii::t('CoreModule.core', 'php version'); ?>
    <small class="label label-info" title="<?php echo phpversion(); ?>"><?php echo phpversion(); ?></small>
    
</p>



