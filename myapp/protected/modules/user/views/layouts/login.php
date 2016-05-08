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
<html lang="<?= Yii::app()->getLanguage(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo CHtml::encode(Yii::app()->name); ?> <?php echo CHtml::encode($this->pageTitle); ?></title>
    <?php
    $mainAssets = Yii::app()->getAssetManager()->publish(
        Yii::getPathOfAlias('application.modules.core.views.assets')
    );
     Yii::app()->getClientScript()->registerCssFile('/css/bootstrap.css');
    Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/styles.css');
    Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/main.js');
    Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/jquery.li-translit.js');
    if (($langs = $this->core->getLanguageSelectorArray()) != []) {
        Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/flags.css');
    }
    ?>
    <link rel="shortcut icon" href="<?php echo $mainAssets; ?>/img/favicon.ico"/>

</head>

<body>
<div id="overall-wrap">
    <!-- mainmenu -->
    <?php $brandTitle = Yii::t('UserModule.user', 'Control panel'); ?>
    <?php
    $this->widget(
        'bootstrap.widgets.TbNavbar',
        [
            //'type' => 'inverse',
            'fluid'    => true,
            'collapse' => true,
            'fixed'    => 'top',
            'brand'    => CHtml::image(
                    Yii::app()->getModule('core')->getLogo(),
                    CHtml::encode(Yii::app()->name),
                    [
                        'height' => '38',
                        'title'  => CHtml::encode(Yii::app()->name),
                    ]
                ),
            'brandUrl' => CHtml::normalizeUrl(["/core/backend/index"]),
            'items'    => [
                [
                    'class'       => 'bootstrap.widgets.TbMenu',
                    'htmlOptions' => ['class' => 'pull-right'],
                    'type'        => 'navbar',
                    'encodeLabel' => false,
                    'items'       => array_merge(
                        [
                            
                            [
                                'icon'    => 'fa fa-fw fa-home',
                                'label'   => Yii::t('CoreModule.core', 'Go home'),
                                'visible' => Yii::app()->getController(
                                    ) instanceof core\components\controllers\BackController === true,
                                'url'     => Yii::app()->createAbsoluteUrl('/')
                            ],
                        ],
                        $this->core->getLanguageSelectorArray()
                    ),
                ],
            ],
        ]
    ); ?>

    <div class="container-fluid" id="page">
        <div class="row">
            <?php echo $content; ?>
        </div>
    </div>
    <div id="footer-guard"></div>
</div>

<footer>
    &copy; 2012 - <?php echo date('Y'); ?>
    <?php echo $this->core->poweredBy(); ?>
</footer>
</body>
</html>
