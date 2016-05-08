<?php
$this->title = [Yii::t('UserModule.user', 'Sign up'), Yii::app()->getModule('core')->siteName];
$this->breadcrumbs = [Yii::t('UserModule.user', 'Sign up')];
?>

<?php $this->widget('core\widgets\YFlashMessages'); ?>

<?php $form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    [
        'id'          => 'registration-form',
        'type'        => 'vertical',
        'enableAjaxValidation' => true,
        'clientOptions' => array(
                'validateOnSubmit' => true,
                //'validateOnChange' => false,
            ),
        'htmlOptions' => [
            'class' => 'well bg-white registration-form',
        ]
    ]
); ?>

<?= $form->errorSummary($model); ?>
                       
<!-- start: REGISTER BOX -->
<div class="box-register">
        <div id="natiyfs-registration"></div>
            <fieldset>
                <legend>Регистрация</legend>
                <p>Введите свои личные данные:</p>
                <div class="form-group">
                        <?= $form->textField($model, 'first_name',array(
                            'class'=>'form-control',
                            'placeholder'=>'Имя'
                            )); ?>
                </div>
                <div class="form-group">
                       <?= $form->textField($model, 'last_name',array(
                           'class'=>'form-control',
                           'placeholder'=>'Фамилия'
                           )); ?>
                </div>
                <div class="form-group">
                    <?php
                        echo $form->maskedTextFieldGroup($model, 'phone', array(
                            'widgetOptions'=>array(
                                 'mask' => '+998-(ii)-iii-iiii',
                                 'charMap' => array('i' => '[0-9]'),
                                 'placeholder' => '_',
                                //'completed' => 'function(){console.log("ok");}',
                                 'htmlOptions'=>array(
                                     'class' => 'form-control',
                                     'maxlength'=>17,
                                     'placeholder'=>'Мобильный телефон'
                                     )
                             )));
                        ?>
                </div>
                <div class="form-group">
                    <label class="block">Я регистрируюсь как:</label> 
                    <div class="clip-radio radio-primary">
                        <?= $form->radioButtonList($model,'user_type',User::getUserTypeList(),array('separator'=>' '));?>
                    </div>
                </div>

                <div class="form-group">
                    <span class="input-icon">
                        <?= $form->textField($model, 'email',array(
                            'class'=>'form-control',
                            'placeholder'=>'Ваш e-mail'
                            )); ?>
                        <i class="fa fa-envelope"></i> 
                    </span>
                </div>
                <div class="form-group">
                    <span class="input-icon">
                    <?= $form->passwordField($model, 'password',array(
                        'class'=>'form-control',
                        'placeholder'=>'Пароль'
                        )); ?>
                        <i class="fa fa-lock"></i> 
                    </span>
                </div>
                <div class="form-group">
                    <span class="input-icon">
                    <?= $form->passwordField($model, 'cPassword',array(
                        'class'=>'form-control',
                        'placeholder'=>'Повторите пароль'
                        )); ?>
                        <i class="fa fa-lock"></i> 
                    </span>
                </div>
                <div class="form-group">
                    <div class="checkbox clip-check check-primary">
                        <?= $form->checkBox($model,'agree',  array()); ?>
                        <label for="RegistrationForm_agree">Я согласен</label>
                    </div>
                </div>

    <div class="form-actions">
<?php if ($module->showCaptcha && CCaptcha::checkRequirements()): { ?> 
        <div class="row" id="captcha_block_reg">
        <div class="col-xs-4">
            <span class="input-icon"> 
            <?= $form->textField(
                $model,
                'verifyCode',
                ['hint' => Yii::t('UserModule.user', 'Please enter the text from the image'),'class'=>'form-control']
            ); ?>
            <i class="fa fa-paw"></i>
            </span>
        </div>
        <div class="col-xs-5">
            <?php $this->widget(
                'CCaptcha',
                [
                    'showRefreshButton' => true,
                    'imageOptions'      => [
                        'width' => '120',
                        'height' => '34',
                    ],
                    'buttonOptions'     => [
                        'class' => 'btn btn-default',
                    ],
                    'buttonLabel'       => '<i class="glyphicon glyphicon-repeat"></i>',
                ]
            ); ?>
        </div>
    </div>
<?php } endif; ?>        
        
        <p class="noAccount">Уже есть аккаунт?
            <a data-toggle="modal" data-target="#myModal" data-dismiss="modal" aria-label="Close">Войти</a>
        </p>

        <?php
        $this->widget(
            'bootstrap.widgets.TbButton',
            [
                'buttonType'  => 'ajaxSubmit',
                'context'     => 'primary',
                'icon'        => 'fa fa-arrow-circle-right',
                'url' => Yii::app()->createUrl('/registration'),
                'label'       => Yii::t('UserModule.user', 'Sign up'),
                'htmlOptions' => ['id' => 'registration-ajax','name' => 'registration-btn','class'=>'btn btn-primary pull-right'],
                'ajaxOptions' => array(
                    'cache' => false,
                    'update' => '#contentAjax',
                    'beforeSend' => 'function() {
                        jQuery("body").off("click", "#registration-ajax");
                        //$(".content *").remove();
                        $(".content").addClass("loading");
                    }',
                    'complete' => 'function() {
                        $(".content").removeClass("loading");
                    }', 
                 ),
            ]
        ); ?>
								
        </div>
    </fieldset>
</div>
<!-- end: REGISTER BOX -->
<?php $this->endWidget(); ?>
<!-- form -->
