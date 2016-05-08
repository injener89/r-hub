<!-- Default Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" style="background-color:#fff;">
				
				<div class="modal-body" >
					<!-- start: LOGIN BOX -->
				<div class="box-login" >
 <?php $form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array(
            'id'=>'login-form',
            'type'=>'vertical',
            'enableAjaxValidation' => true,  // активируем ajax-валидацию, при ошибках ввода логина/пароля - ошибка будет отображаться в нашем модальном окне
            //'enableClientValidation'=>true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
                //'validateOnChange' => false,
            ),
            'htmlOptions'=>[
            'class' => 'login-form',
        ],
        )     
         
); ?>	
<div id="natiyfs-login"></div>
<fieldset>
    <legend>
            Вход в персональный кабинет
    </legend>
    <p>
            Пожалуйста, введите ваше ID и пароль для входа в систему
    </p>

    <div class="form-group">
            <span class="input-icon">
                    <?= $form->textField($model, 'email',array('class'=>'form-control','placeholder'=>'ID или Email')); ?>
                    <!--<input type="text" class="form-control" name="username" placeholder="ID">-->
                    <i class="fa fa-user"></i> </span>
    </div>
    <div class="form-group form-actions">
            <span class="input-icon">
                    <?= $form->passwordField($model, 'password',array('class'=>'form-control','placeholder'=>'Пароль')); ?>
       
                    <i class="fa fa-lock"></i>
                    <a class="forgot" data-toggle="modal" data-target="#forgot" data-dismiss="modal" aria-label="Close">
                            Я забыл свой пароль
                    </a> 
                    <div class="clears"></div>
            </span>
    </div>
    <div class="form-actions">
            <div class="checkbox clip-check check-primary">
                    <?= $form->checkBox($model, 'remember_me',array('id'=>'remember','value'=>'1')); ?>
                   
                    <label for="remember">
                            Запомнить меня
                    </label>
            </div>
 <?php if (Yii::app()->getUser()->getState('badLoginCount', 0) >= 3 && CCaptcha::checkRequirements('gd')): { ?>
        <style>
            .row#captcha_block
            {
                display: block;
            }
        </style>
 <?php } endif; ?>        
    <div class="row" id="captcha_block">
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
                    //'id'=>'login-form-cap',
                    //'captchaAction' => '/site/captcha',
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
        <input class="hidden" type="hidden" name="ajax" value="login-form"  >        

        <?php
        $htmls = "<div role='alert' class='alert'></div>";
        $this->widget(
            'bootstrap.widgets.TbButton',
            [
                'buttonType'  => 'ajaxSubmit',
                'context'     => 'primary',
                'url' => Yii::app()->createUrl('/'),
                'icon'        => 'fa fa-arrow-circle-right',
                'label'       => Yii::t('UserModule.user', 'Sign in'),
                'htmlOptions' => ['name' => 'login-btn','class'=>'btn btn-primary pull-right'],
                'ajaxOptions' => array(
                    'beforeSend' => 'function(data){
                        $(".login-form .form-actions button.btn").text("Авторизация...");
                    }',
                    'success' => 'function(data){
                        var $html = "'.$htmls.'"; 
                        var $htmlObj = $($html);
                        if (data=="200") {}
                        else if (data=="400") {}
                        else {
                            var response= jQuery.parseJSON (data);
                            $(".form-actions .row .col-xs-5 a.btn").trigger("click");
                            $.each(response, function(key, value) {
  
                                    if(key == "RCount"){
                                       if(value == 1){
                                          $("#captcha_block").css({"display":"block"});
                                       } 
                                    }
                                    if(key == "status"){
                                       if(value == 1){
                                          $(".login-form .form-actions button.btn").text("OK");
                                       } else {
                                           $(".login-form .form-actions button.btn").text("'.Yii::t('UserModule.user', 'Sign in').'");
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
                                    
                                    $("#natiyfs-login").html($htmlObj);
                                    
                            });
                        }
                }'),
            ]
        ); ?>
    </div>
    <div class="new-account">
            Не зарегистрировались?
            <?php echo CHtml::link('Регистрация', array('/user/account/registration')); ?>
    </div>
</fieldset>
<?php $this->endWidget(); ?>
                                    
</div>
				<!-- end: LOGIN BOX -->
	     </div>	
	</div>
    </div>
</div>
<!-- /Default Modal -->