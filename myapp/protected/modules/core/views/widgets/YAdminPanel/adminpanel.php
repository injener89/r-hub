<?php
/**
 * Отображение для виджета YAdminPanel:
 *
 * @category CoreView
 * @package  core
 * @author   Timur <injener89@gmail.com>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.1
 * @link     http://websum.uz
 *
 **/


$mainAssets = Yii::app()->getAssetManager()->publish(
    Yii::getPathOfAlias('application.modules.core.views.assets')
);

$this->widget(
    'bootstrap.widgets.TbNavbar',
    [
        'fluid'    => true,
        'fixed'    => 'top',
        'brand'    => CHtml::image(
            $mainAssets . '/img/logo.png',
            CHtml::encode(Yii::app()->name),
            [
                'width'  => '112',
                'height' => '38',
                'title'  => CHtml::encode(Yii::app()->name),
            ]
        ),
        'brandUrl' => CHtml::normalizeUrl(["/core/backend/index"]),
        'items'    => [
            [
                'class' => 'bootstrap.widgets.TbMenu',
                'type'  => 'navbar',
                'encodeLabel' => false,
                'items' => $modules
            ],
            [
                'class'       => 'bootstrap.widgets.TbMenu',
                'htmlOptions' => ['class' => 'navbar-right visible-xs hidden-sm hidden-md visible-lg'],
                'type'        => 'navbar',
                'encodeLabel' => false,
                'items'       => array_merge(
                    [
                        [
                            'icon' => 'fa fa-fw fa-home',
                            'label' => CHtml::tag(
                                    'span',
                                    ['class' => 'hidden-sm hidden-md hidden-lg'],
                                    Yii::t('CoreModule.core', 'Go home')
                                ),
                            'url' => Yii::app()->createAbsoluteUrl('/')
                        ],
                        [
                            'icon' => 'fa fa-fw fa-user',
                            'label' => '<span class="label label-info">' . CHtml::encode(
                                    Yii::app()->getUser()->getProfileField('fullName')
                                ) . '</span>',
                            'items' => [
                                [
                                    'icon' => 'fa fa-fw fa-cog',
                                    'label' => Yii::t('CoreModule.core', 'Profile'),
                                    'url' => CHtml::normalizeUrl(
                                            (['/user/userBackend/update', 'id' => Yii::app()->getUser()->getId()])
                                        ),
                                ],
                                [
                                    'icon' => 'fa fa-fw fa-power-off',
                                    'label' => Yii::t('CoreModule.core', 'Exit'),
                                    'url' => CHtml::normalizeUrl(['/user/account/logout']),
                                ],
                            ],
                        ],
                    ],
                    $this->getController()->core->getLanguageSelectorArray()
                ),
            ],
        ],
    ]
);?>

<script type="text/javascript">
    $(document).ready(function () {
        var url = window.location.href;
        $('.navbar .nav li').removeClass('active');
        $('.nav a').filter(function () {
            return this.getAttribute("href") != '#' && this.href == url;
        }).parents('li').addClass('active');
    });
</script>
