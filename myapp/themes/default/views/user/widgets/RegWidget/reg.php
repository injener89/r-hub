<!-- Default Modal -->
	<div class="modal fade" id="registor" tabindex="-1" role="dialog" aria-labelledby="registorLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" style="background-color:#fff;">
				<div class="modal-body" >
<?php $form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    [
        'id' => 'registration-form',
        'type' => 'vertical',
        'enableAjaxValidation' => true,  // активируем ajax-валидацию, при ошибках ввода логина/пароля - ошибка будет отображаться в нашем модальном окне
        //'enableClientValidation'=>true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => false,
        ),
        'htmlOptions' => [
            'class' => 'registration-form',
        ]
    ]
); ?>                                    
<!-- start: REGISTER BOX -->
<div class="box-register panel-scroll height-500 ps-container ps-active-y">
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
                        <input type="radio" id="rg-female" name="gender" value="female">
                        <label for="rg-female">Физическое лицо</label>
                        <input type="radio" id="rg-male" name="gender" value="male">
                        <label for="rg-male">Юридическое лицо</label>
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
                        <input type="checkbox" id="agree" value="agree">
                        <label for="agree">Я согласен</label>
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
        
        <p>Уже есть аккаунт?
            <a data-toggle="modal" data-target="#myModal" data-dismiss="modal" aria-label="Close">Войти</a>
        </p>
        <input class="hidden" type="hidden" name="ajax" value="registration-form"  >        

        <?php
        $htmls = "<div role='alert' class='alert'></div>";
        $this->widget(
            'bootstrap.widgets.TbButton',
            [
                'buttonType'  => 'ajaxSubmit',
                'context'     => 'primary',
                'url' => Yii::app()->createUrl('/'),
                'icon'        => 'fa fa-arrow-circle-right',
                'label'       => Yii::t('UserModule.user', 'Sign up'),
                'htmlOptions' => ['name' => 'registration-btn','class'=>'btn btn-primary pull-right'],
                'ajaxOptions' => array(
                    'beforeSend' => 'function(data){
                        $(".login-form .form-actions button.btn").text("Регистрация...");
                    }',
                    'success' => 'function(data){
                        var $html = "'.$htmls.'"; 
                        var $htmlObj = $($html);
                        if (data=="200") {}
                        else if (data=="400") {}
                        else {
                            var response= jQuery.parseJSON (data);
                            $("a#yw4_button").trigger("click");
                            $.each(response, function(key, value) {
                                    if(key == "RCount"){
                                       if(value == 1){
                                          
                                       } 
                                    }
                                    if(key == "status"){
                                       if(value == 1){
                                          $(".registration-form .form-actions button.btn").text("OK");
                                       } else {
                                           $(".registration-form .form-actions button.btn").text("'.Yii::t('UserModule.user', 'Sign up').'");
                                        }
                                    }
                                    if(key == "massage"){
                                        $htmlObj.html(value);
                                    }
                                    if(key == "class"){
                                        $htmlObj.addClass(value);
                                    }
                                    if(key == "redirect"){
                                        if(value == 0){} 
                                        else {
                                           window.location.href = value;
                                        }
                                    }
                                    $("#natiyfs-registration").html($htmlObj);
                            });
                        }
                }'),
            ]
        ); ?>
								
        </div>
    </fieldset>
        <div class="ps-scrollbar-y-rail"><div class="ps-scrollbar-y" ></div></div>
</div>
<!-- end: REGISTER BOX -->
<?php $this->endWidget(); ?>
<!-- form -->
</div>
</div>
</div>
</div>
<!-- /Default Modal -->








