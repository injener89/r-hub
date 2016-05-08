<?php
/**
 * Отображение для layouts/main:
 *
 * @category CoreLayout
 * @package  core
 * @author   Core Team <team@websum.uz>
 * @license  https://github.com/core/core/blob/master/LICENSE BSD
 * @link     http://websum.uz
 **/
?>
<!DOCTYPE html>
<html lang="<?= Yii::app()->getLanguage();?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= CHtml::encode(Yii::app()->name); ?> <?= CHtml::encode($this->pageTitle); ?></title>
    <?php
    $mainAssets = Yii::app()->getAssetManager()->publish(
        Yii::getPathOfAlias('application.modules.core.views.assets')
    );
    Yii::app()->getClientScript()->registerCssFile('/css/bootstrap.css');
    Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/styles.css');
    Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/bootstrap-notify.css');
    
    //Yii::app()->getClientScript()->registerCssFile('/cliptwo/assets/css/styles.css');
    //Yii::app()->getClientScript()->registerCssFile('/cliptwo/assets/css/plugins.css');
    //Yii::app()->getClientScript()->registerCssFile('/cliptwo/assets/css/themes/theme-1.css');
    
    Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/main.js');
    Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/bootstrap-notify.js');
    Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/jquery.li-translit.js');
    
    //Yii::app()->getClientScript()->registerScriptFile('/cliptwo/vendor/jquery/jquery.min.js');
    //Yii::app()->getClientScript()->registerScriptFile('/cliptwo/vendor/bootstrap/js/bootstrap.min.js');
 
    /*Yii::app()->getClientScript()->registerScriptFile('/cliptwo/vendor/modernizr/modernizr.js');
    Yii::app()->getClientScript()->registerScriptFile('/cliptwo/vendor/jquery-cookie/jquery.cookie.js');
    Yii::app()->getClientScript()->registerScriptFile('/cliptwo/vendor/perfect-scrollbar/perfect-scrollbar.min.js');
    Yii::app()->getClientScript()->registerScriptFile('/cliptwo/vendor/switchery/switchery.min.js');

    Yii::app()->getClientScript()->registerScriptFile('/cliptwo/vendor/Chart.js/Chart.min.js');
    Yii::app()->getClientScript()->registerScriptFile('/cliptwo/vendor/jquery.sparkline/jquery.sparkline.min.js');
    Yii::app()->getClientScript()->registerScriptFile('/cliptwo/assets/js/main.js');
    Yii::app()->getClientScript()->registerScriptFile('/cliptwo/assets/js/index.js');*/
    
		
    
    if (($langs = $this->core->getLanguageSelectorArray()) != []) {
        Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/flags.css');
    }
    ?>
    <script>
			/*jQuery(document).ready(function() {
				Main.init();
				Index.init();
			});*/
    </script>
    <style>
.input-group-addon 
{
    padding: 6px 12px;
    font-size: 14px;
    height: 37px;
    font-weight: normal;
    line-height: 1;
    color: #555;
    text-align: center;
    background-color: #eee;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.form-control {
    display: block;
    width: 100%;
    height: 36px;
    padding: 4px 12px 4px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    
    
    
}
.table-condensed > thead > tr > th, .table-condensed > tbody > tr > th, 
    .table-condensed > tfoot > tr > th, .table-condensed > thead > tr > td, 
    .table-condensed > tbody > tr > td, .table-condensed > tfoot > tr > td {
    vertical-align: middle;
} 

#medicament-grid .input-sm
{
    width: 460px;
}
.grey
{
    color: #fff;
    float: left;
    padding: 3px 8px 2px 8px;
    background-color: #86C193;
}
.orenge
{
    color: #333;
    float: left;
    padding: 3px 8px 2px 8px;
    background-color: #E3C54D;
}
.other_date
{
    color: #333;
    float: left;
    padding: 3px 8px 2px 8px;
    background-color: #FC6665;
}
.MedExcel .btn{
    float: left; 
    margin-right: 5px;
}
.pastavshiki
{
    width: 380px;
    float: left;
    margin-right: 15px;
}
.status_service{
    float: left;
}
.s_run
{
    background-color: #cec;
    padding: 7px 10px 7px 10px;
    margin-left: 0px;
}
.s_stop, .s_error
{
    background-color: #FC6665;
    padding: 7px 10px 7px 10px;
    margin-left: 0px;
}

    </style>
    
    
    <?php
    Yii::app()->getClientScript()->registerScript(
        'coreToken',
        'var actionToken = ' . json_encode(
            [
                'token'      => Yii::app()->getRequest()->csrfTokenName . '=' . Yii::app()->getRequest()->csrfToken,
                'url'        => Yii::app()->createAbsoluteUrl('core/modulesBackend/moduleStatus'),
                'message'    => Yii::t('CoreModule.core', 'Wait please, your request in process...'),
                'error'      => Yii::t(
                        'CoreModule.core',
                        'During the processing of your request an unknown error occurred =('
                    ),
                'loadingimg' => CHtml::image(
                        $mainAssets . '/img/progressbar.gif',
                        '',
                        [
                            'style' => 'width: 100%; height: 20px;',
                        ]
                    ),
                'buttons'    => [
                    'yes' => Yii::t('CoreModule.core', 'Ok'),
                    'no'  => Yii::t('CoreModule.core', 'Cancel'),
                ],
                'messages'   => [
                    'confirm_update'           => Yii::t(
                            'CoreModule.core',
                            'Do you really want to update configuration file?'
                        ),
                    'confirm_deactivate'       => Yii::t(
                            'CoreModule.core',
                            'Do you really want to disable module? We disable all dependent modules!'
                        ),
                    'confirm_activate'         => Yii::t('CoreModule.core', 'Do you really want to enable module?'),
                    'confirm_uninstall'        => Yii::t(
                            'CoreModule.core',
                            'Do you really want to delete module?'
                        ) . '<br />' . Yii::t('CoreModule.core', 'All module parameters will be deleted'),
                    'confirm_install'          => Yii::t(
                            'CoreModule.core',
                            'Do you really want to install module?'
                        ) . '<br />' . Yii::t('CoreModule.core', 'New module parameters will be added'),
                    'confirm_cacheFlush'       => Yii::t('CoreModule.core', 'Do you really want to clean cache?'),
                    'confirm_cacheAll'         => Yii::t('CoreModule.core', 'Do you really want to clean cache?'),
                    'confirm_assetsFlush'      => Yii::t('CoreModule.core', 'Do you really want to clean assets?'),
                    'confirm_cacheAssetsFlush' => Yii::t(
                            'CoreModule.core',
                            'Do you really want to clean cache and assets?'
                        ) . '<br />' . Yii::t('CoreModule.core', 'This process can take much time!'),
                    'unknown'                  => Yii::t('CoreModule.core', 'Unknown action was selected!'),
                ]
            ]
        ),
        CClientScript::POS_BEGIN
    );
    ?>
    <link rel="shortcut icon" href="<?= $mainAssets; ?>/img/favicon.ico"/>

</head>

<body>
   
<div id="overall-wrap">
    <!-- mainmenu -->
    <?php
    $this->widget('core\widgets\YAdminPanel'); ?>
    <div class="container-fluid" id="page"><?= $content; ?></div>
    <div id="footer-guard"></div>
</div>

<div class='notifications top-right' id="notifications"></div>




<footer>
    &copy; 2015 - <?= date('Y'); ?>
    <?= $this->core->poweredBy(); ?>
    <small class="label label-info"><?= $this->core->getVersion(); ?></small>
    <?php $this->widget('core\widgets\YPerformanceStatistic'); ?>
</footer>
</body>
</html>
