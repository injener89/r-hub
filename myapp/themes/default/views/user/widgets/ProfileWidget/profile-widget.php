<?php Yii::import('application.modules.user.UserModule'); ?>
<div class="wrap-content container"> 
<div class="widget last-login-users-widget">
    
<div class="panel panel-white collapses" id="panel5">
    <div class="panel-heading">
            <h4 class="panel-title text-primary">
                <?= '<strong>Добро пожаловать, </strong> '.$user->last_name.' '.$user->first_name.' '.$user->middle_name; ?>
                <?= ' Ваш ID - '.$user->sid; ?>
            </h4>
            <div class="panel-tools">
                    <a data-original-title="Персональные разделы" data-toggle="tooltip" data-placement="right" class="btn btn-transparent btn-sm panel-collapse" href="#"><i class="ti-minus collapse-off"></i><i class="ti-plus collapse-on"></i></a>
            </div>
    </div>
    <div class="panel-body">
            <div class="row">
            <div class="col-xs-2">
                <?= CHtml::link(
                    $this->widget(
                        'application.modules.user.widgets.AvatarWidget',
                        ['user' => $user, 'noCache' => true, 'imageHtmlOptions' => ['width' => 100, 'height' => 100]],
                        true
                    ),
                    ['/user/profile/profile/', 'sid' => $user->sid],
                    ['title' => Yii::t('UserModule.user', 'User profile')]
                ); ?>
            </div>
     <div class="col-xs-6">
                
                <ul class="user-info">
                    <?php if(Yii::app()->hasModule('notify')):?>
                        <?php $this->widget(
                            'bootstrap.widgets.TbButton',
                            [
                                'label'      => Yii::t('UserModule.user', 'Notify settings'),
                                'icon'       => 'glyphicon glyphicon-pencil',
                                'buttonType' => 'link',
                                'context'    => 'link',
                                'url'        => ['/notify/notify/settings/'],
                            ]
                        ); ?>
                    <?php endif;?>
                    

                    <li>
                        <?php $this->widget(
                            'bootstrap.widgets.TbButton',
                            [
                                'label'      => 'Статистика платежей',
                                'icon'       => 'glyphicon glyphicon-stats',
                                'buttonType' => 'link',
                                'context'    => 'link',
                                'url'        => ['#'],
                            ]
                        ); ?>
                    </li>
                    
                    
                    <li>
                        <?php $this->widget(
                            'bootstrap.widgets.TbButton',
                            [
                                'label'      => 'Настройка личных данных',
                                'icon'       => 'glyphicon glyphicon-pencil',
                                'buttonType' => 'link',
                                'context'    => 'link',
                                'url'        => ['/user/profile/profile/'],
                            ]
                        ); ?>
                    </li>   
                </ul>
                
            </div>
        </div>
    </div>
</div> 
            <!--<i class="glyphicon glyphicon-user"></i>
        
        <li>
                        <i class="glyphicon glyphicon-envelope"></i> <? //$user->email; ?>
                    </li>
        -->
            <?php // Yii::t('UserModule.user', 'My profile'); ?>
</div>
 </div> 

