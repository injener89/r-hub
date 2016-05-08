<!DOCTYPE html>
<html lang="<?= Yii::app()->language; ?>">
<head>
    <?php \core\components\TemplateEvent::fire(DefautThemeEvents::HEAD_START);?>
    <?php Yii::app()->getController()->widget(
        'vendor.chemezov.yii-seo.widgets.SeoHead',
        array(
            'httpEquivs' => array(
                'Content-Type' => 'text/html; charset=utf-8',
                'X-UA-Compatible' => 'IE=edge,chrome=1',
                'Content-Language' => 'ru-RU'
            ),
            'defaultTitle' => $this->core->siteName,
            'defaultDescription' => $this->core->siteDescription,
            'defaultKeywords' => $this->core->siteKeyWords,
        )
    ); ?>

    <?php
    $mainAssets = Yii::app()->getTheme()->getAssetsUrl();
    Yii::app()->getClientScript()->registerCssFile($mainAssets .'/js/themify-icons/themify-icons.min.css');
    Yii::app()->getClientScript()->registerCssFile($mainAssets .'/js/animate.css/animate.min.css');
    Yii::app()->getClientScript()->registerCssFile($mainAssets .'/js/perfect-scrollbar/perfect-scrollbar.min.css');
    Yii::app()->getClientScript()->registerCssFile($mainAssets .'/js/switchery/switchery.min.css');
    //Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/flags.css');
    //Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/core.css');
    Yii::app()->getClientScript()->registerCssFile('/css/fractionslider.css');
    Yii::app()->getClientScript()->registerCssFile('/css/daterangepicker.css');
     
    Yii::app()->getClientScript()->registerCssFile('/css/styles.css');
    Yii::app()->getClientScript()->registerCssFile('/css/plugins.css');
    Yii::app()->getClientScript()->registerCssFile('/css/themes/theme-4.css');

    //Yii::app()->getClientScript()->registerCssFile('/css/owl.carousel.css');
   // Yii::app()->getClientScript()->registerCssFile('/css/owl.theme.default.css');
    //Yii::app()->getClientScript()->registerCssFile('/css/owl.animate.css');

    
 
    Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/blog.js');
    Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/bootstrap-notify.js');
    Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/jquery.li-translit.js');
    Yii::app()->getClientScript()->registerScriptFile('/js/jquery.fractionslider.js');
    
    Yii::app()->getClientScript()->registerScriptFile('/js/moment.min.js');
    Yii::app()->getClientScript()->registerScriptFile('/js/daterangepicker.js');
    //Yii::app()->getClientScript()->registerScriptFile('/js/owl.carousel.js');
   
    ?>
   
    <meta http-equiv="Cache-Control" content="no-cache">
    <script type="text/javascript">
        var coreTokenName = '<?= Yii::app()->getRequest()->csrfTokenName;?>';
        var coreToken = '<?= Yii::app()->getRequest()->getCsrfToken();?>';
    </script>
    <!--[if IE]>
    <!--<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>-->
    <![endif]-->
    <!--<link rel="stylesheet" href="http://yandex.st/highlightjs/8.2/styles/github.min.css">
    <script src="http://yastatic.net/highlightjs/8.2/highlight.min.js"></script>-->
    <?php \core\components\TemplateEvent::fire(DefautThemeEvents::HEAD_END);?>
</head>

<body>

<?php \core\components\TemplateEvent::fire(DefautThemeEvents::BODY_START);?>
 <div id="app">
			
    <div class="app-content">
            <!-- start: TOP NAVBAR -->
            <header class="navbar navbar-default navbar-static-top">
                <?php if (Yii::app()->hasModule('menu')): ?>
                    <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'glavnoe-menyu']); ?>
                <?php endif; ?>
            </header>
            
            <div class="line_top"></div>
            <!-- end: TOP NAVBAR -->
            
            
<div class="main-content" >  
   
<?php if (Yii::app()->getUser()->isAuthenticated()): ?>
<?php $this->widget('application.modules.user.widgets.ProfileWidget'); ?>
<?php endif; ?>
<div class="clears"></div>
              
<div class="wrap-content container" id="container">
    
 <div class="left_menu_hiddon">
     <div class="left_menu">
         <div class="left_menu_arnament"></div>
         <h2>Платежи</h2>
         <ul class="home_menu">
             <li id="item-1"><a> <i class="fa fa-mobile"></i><span> Сотовая связь</span></a>
                 <div class="child_col">
                     <div class="left_menu_arnament"></div>
                     <h2>Сотовая связь</h2>
                     <a href="#f"><i class="fa fa-arrow-circle-left"></i><span> Назад</span></a>
                     <div class="clears"></div>
                     <ul class="child_menu">
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Beeline</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Perfectum</span></a> </li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Uzmobile</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Ucell</span></a> </li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>UMS</span></a></li>
                     </ul>
                 </div>
             </li>
             <li id="item-2"><a><i class="fa fa-globe"></i> <span>Интернет</span></a>
                 <div class="child_col">
                     <div class="left_menu_arnament"></div>
                     <h2>Интернет</h2>
                     <a href="#f"><i class="fa fa-arrow-circle-left"></i><span> Назад</span></a>
                     <div class="clears"></div>
                     <ul class="child_menu">
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Skyline.uz</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>St.uz</span></a> </li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Comnet.uz</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Evo.uz</span></a> </li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>TPS.UZ</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>ETC Интернет</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>ETC Счет</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Uzonline.uz</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Buzton (Beeline)</span></a></li>
                     </ul>
                 </div>
             </li>
             <li id="item-3"><a><i class="fa fa-desktop"></i> <span>Телевидение</span></a>
                 <div class="child_col">
                     <div class="left_menu_arnament"></div>
                     <h2>Телевидение</h2>
                     <a href="#f"><i class="fa fa-arrow-circle-left"></i><span> Назад</span></a>
                     <div class="clears"></div>
                     <ul class="child_menu">
                         <li><a href="#"><i class="fa fa-circle"></i> <span>UZDIGITAL TV</span></a> </li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>ETC IPTV</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Mediabay</span></a> </li>
                     </ul>
                 </div>
             </li>
             <li id="item-4"><a><i class="fa fa-phone"></i> <span>Телефония</span></a>
                 <div class="child_col">
                     <div class="left_menu_arnament"></div>
                     <h2>Телефония</h2>
                     <a href="#f"><i class="fa fa-arrow-circle-left"></i><span> Назад</span></a>
                     <div class="clears"></div>
                     <ul class="child_menu">
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Platinum connect</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Platinum mobile</span></a> </li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Центральный телеграф</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>ETC Телефония</span></a> </li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Городской телефон</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Междугородный счет</span></a></li>
                     </ul>
                 </div>
             </li>
             <li id="item-5"><a><i class="fa fa-shopping-cart"></i> <span>Интернет-магазины</span></a>
                 <div class="child_col">
                     <div class="left_menu_arnament"></div>
                     <h2>Интернет-магазины</h2>
                     <a href="#f"><i class="fa fa-arrow-circle-left"></i><span> Назад</span></a>
                     <div class="clears"></div>
                     <ul class="child_menu">
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Comfy.uz</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Nav.uz</span></a> </li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Tabaka.uz</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Matras.uz</span></a> </li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Beanbag.uz</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Avtech.uz</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Nazakaz.uz</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Hilolnashr.uz</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Vampodarok.uz</span></a></li>
                     </ul>
                 </div>
             </li>
             <li id="item-6"><a><i class="fa fa-gamepad"></i> <span>Игры</span></a> 
                <div class="child_col">
                     <div class="left_menu_arnament"></div>
                     <h2>Игры</h2>
                     <a href="#f"><i class="fa fa-arrow-circle-left"></i><span> Назад</span></a>
                     <div class="clears"></div>
                     <ul class="child_menu">
                         <li><a href="#"><i class="fa fa-circle"></i> <span>World Of Tanks</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Mail.ru игры</span></a> </li>
                     </ul>
                 </div>
             </li>
             <li id="item-7"><a><i class="fa fa-plane"></i> <span>Авиабилеты</span></a> 
                <div class="child_col">
                     <div class="left_menu_arnament"></div>
                     <h2>Авиабилеты</h2>
                     <a href="#f"><i class="fa fa-arrow-circle-left"></i><span> Назад</span></a>
                     <div class="clears"></div>
                     <ul class="child_menu">
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Москва</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Алмата</span></a> </li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Ташкент</span></a></li>
                     </ul>
                 </div>
             </li>
             <li id="item-8"><a><i class="fa fa-train"></i> <span>Ж/Д билеты</span></a> 
                 <div class="child_col">
                     <div class="left_menu_arnament"></div>
                     <h2>Ж/Д билеты</h2>
                     <a href="#f"><i class="fa fa-arrow-circle-left"></i><span> Назад</span></a>
                     <div class="clears"></div>
                     <ul class="child_menu">
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Tashkent</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Buxara</span></a> </li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Samarqand</span></a></li>
                     </ul>
                 </div>
             </li>
             <li id="item-9"><a><i class="fa fa-truck"></i> <span>Сервисы доставки</span></a> 
                 <div class="child_col">
                     <div class="left_menu_arnament"></div>
                     <h2>Сервисы доставки</h2>
                     <a href="#f"><i class="fa fa-arrow-circle-left"></i><span> Назад</span></a>
                     <div class="clears"></div>
                     <ul class="child_menu">
                         <li><a href="#"><i class="fa fa-circle"></i> <span>DHL</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Почта</span></a> </li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>EMS</span></a></li>
                     </ul>
                 </div>
             </li>
             <li id="item-10"><a><i class="fa fa-home"></i> <span>ЖКХ</span></a> 
                <div class="child_col">
                     <div class="left_menu_arnament"></div>
                     <h2>ЖКХ</h2>
                     <a href="#f"><i class="fa fa-arrow-circle-left"></i><span> Назад</span></a>
                     <div class="clears"></div>
                     <ul class="child_menu">
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Электроэнергия</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Махсустранс</span></a> </li>
                     </ul>
                 </div>
             </li>
             <li id="item-11"><a><i class="fa fa-cab"></i> <span>Штрафы ГАИ</span></a> 

                 <div class="child_col">
                     <div class="left_menu_arnament"></div>
                     <h2>Штрафы ГАИ</h2>
                     <a href="#f"><i class="fa fa-arrow-circle-left"></i><span> Назад</span></a>
                     <div class="clears"></div>
                     <ul class="child_menu">
                        <li><a href="#"><i class="fa fa-circle"></i> <span>Beeline</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Perfectum</span></a> </li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Uzmobile</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Ucell</span></a> </li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>UMS</span></a></li>
                     </ul>
                 </div>
             </li>
             <li id="item-12"><a><i class="fa fa-bank"></i> <span>Налоги</span></a> 
                 <div class="child_col">
                     <div class="left_menu_arnament"></div>
                     <h2>Налоги</h2>
                     <a href="#f"><i class="fa fa-arrow-circle-left"></i><span> Назад</span></a>
                     <div class="clears"></div>
                     <ul class="child_menu">
                        <li><a href="#"><i class="fa fa-circle"></i> <span>Beeline</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Perfectum</span></a> </li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Uzmobile</span></a></li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>Ucell</span></a> </li>
                         <li><a href="#"><i class="fa fa-circle"></i> <span>UMS</span></a></li>
                     </ul>
                 </div>
             </li>
         </ul>

     </div>
       <div class="right_in_menu">
           <a id="itemico-1"><i class="fa fa-mobile"></i></a>
           <a id="itemico-2"><i class="fa fa-globe"></i></a>
           <a id="itemico-3"><i class="fa fa-desktop"></i></a>
           <a id="itemico-4"><i class="fa fa-phone"></i></a>
           <a id="itemico-5"><i class="fa fa-shopping-cart"></i></a>
           <a id="itemico-6"><i class="fa fa-gamepad"></i></a>
           <a id="itemico-7"><i class="fa fa-plane"></i></a>
           <a id="itemico-8"><i class="fa fa-train"></i></a>
           <a id="itemico-9"><i class="fa fa-truck"></i></a>
           <a id="itemico-10"><i class="fa fa-home"></i></a>
           <a id="itemico-11"><i class="fa fa-cab"></i></a>
           <a id="itemico-12"><i class="fa fa-bank"></i></a>
       </div>
   </div>
                    




                    
					
                    <div class="content_block"> <!-- flashMessages -->
                            <?php $this->widget('core\widgets\YFlashMessages'); ?>
                            <!-- breadcrumbs -->
                            <?php $this->widget('bootstrap.widgets.TbBreadcrumbs',['links' => $this->breadcrumbs,]);?>
                            
                            <!-- content col-sm-12 -->
                            <section class="content" id="contentAjax">
                                <?= $content; ?>
                            </section>
                            <!-- content end-->
                            <div class="clears"></div>
                        </div>

    

                    
                    
<div class="clears"></div>

<div class="container-fluid container-fullw bg-white info-block">
                            <div class="row">
                                <div class="col-sm-12">
 WEBSUM - это Система Интернет-розничных платежей, которая позволяет пользователям моментально приобретать, реализовывать товары, оказывать услуги посредством сети Интернет.
</br>
Система построена по бизнес моделям В2С (прямые продажи для потребителя/пользователя) и С2С (Потребитель для Потребителя).
</br>
Все расчеты в системе производятся учетными единицами WEBSUM (WSM). Учетная единица WSM – являться эквивалентом Узбекского национального сума выпущенного казначейством, где 1 (один) сум равен 1(одному) WSM. (1 WSM = 1 сум).
</br>
Со способами пополнения своего электронного кошелька учетными единицами WSM вы можете ознакомиться <a href="/">здесь</a> .
                                </div>
                            </div>
                        </div>




                    <div class="container-fluid container-fullw bg-white info-block">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="panel panel-white no-radius text-center">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-gear fa-stack-1x fa-inverse"></i> </span>
                                            <h2 class="StepTitle">О системе</h2>
                                            <p class="text-small">
                                                ДОБРО ПОЖАЛОВАТЬ в WEBSUM — Систему Интернет – розничных платежей, в среду для ведения электронного бизнеса!
                                            </p>
                                            <p class="links cl-effect-1">
                                                <a href="">
                                                    Подробнее
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="panel panel-white no-radius text-center">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-paperclip fa-stack-1x fa-inverse"></i> </span>
                                            <h2 class="StepTitle">Мерчант</h2>
                                            <p class="text-small">
                                                Мерчант счет является торговым счетом, который используется для приема платежей клиентов интернет-магазинов и компаний.
                                            </p>
                                            <p class="links cl-effect-1">
                                                <a href="">
                                                    Подробнее
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="panel panel-white no-radius text-center">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-smile-o fa-stack-1x fa-inverse"></i> </span>
                                            <h2 class="StepTitle">Акции</h2>
                                            <p class="text-small">
                                                 Мерчант счет является торговым счетом, который используется для приема платежей клиентов интернет-магазинов и компаний.
                                            </p>
                                            <p class="links cl-effect-1">
                                                <a href="">
                                                    Подробнее
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


<div class="container-fluid container-fullw bg-white  info-block">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="over-title margin-bottom-15"><span class="text-bold">Новости</span></h5>
                                
                                    <div class="row">
                                        
                                        <div class="col-sm-3">
                                            <div class="panel panel-white">
                                                <div class="panel-heading border-light">
                                                    <h4 class="panel-title">Зупускаем <span class="text-bold">систему WEBSUM</span></h4>
                                                </div>
                                                <div class="panel-body">
                                                    <p>
                                                        Сообщаем Вам, что запуск новой Системы, с подключением всех мобильных операторов состоится 1 декабря 2015 года. В настоящее время идет тестирование и отладка новой Системы.
                                                    </p>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="panel panel-white">
                                                <div class="panel-heading border-light">
                                                    <h4 class="panel-title">Зупускаем <span class="text-bold">систему</span></h4>
                                                </div>
                                                <div class="panel-body">
                                                    <p>
                                                       Сообщаем Вам, что запуск новой Системы, с подключением всех мобильных операторов состоится 1 декабря 2015 года. В настоящее время идет тестирование и отладка новой Системы.
                                                    </p>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="panel panel-white">
                                                <div class="panel-heading border-light">
                                                    <h4 class="panel-title">Зупускаем <span class="text-bold">систему WEBSUM</span></h4>
                                                </div>
                                                <div class="panel-body">
                                                    <p>
                                                        Сообщаем Вам, что запуск новой Системы, с подключением всех мобильных операторов состоится 1 декабря 2015 года. В настоящее время идет тестирование и отладка новой Системы.
                                                    </p>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="panel panel-white">
                                                <div class="panel-heading border-light">
                                                    <h4 class="panel-title">Зупускаем <span class="text-bold">систему WEBSUM</span></h4>
                                                </div>
                                                <div class="panel-body">
                                                    <p>
                                                        Сообщаем Вам, что запуск новой Системы, с подключением всех мобильных операторов состоится 1 декабря 2015 года. В настоящее время идет тестирование и отладка новой Системы.
                                                    </p>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        

                                        
                                    </div>
                                </div>
                            </div>
                        </div>





<div class="container-fluid container-fullw  bg-white info-block">
        <div class="row">
            <div class="col-sm-6 ">
                <div class="panel panel-transparent">
                    <div class="panel-heading">
                        <div class="panel-title">
                            Мы в социальных сетях
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="social-icons">
                            <ul>
                                <li class="social-twitter" tooltip="Twitter" tooltip-placement="top">
                                    <a target="_blank" href="#">
                                        Twitter
                                    </a>
                                </li>
                                
                                <li class="social-facebook" tooltip="Facebook" tooltip-placement="top">
                                    <a target="_blank" href="#">
                                        Facebook
                                    </a>
                                </li>
                                <li class="social-google" tooltip="Google" tooltip-placement="top">
                                    <a target="_blank" href="#">
                                        Google+
                                    </a>
                                </li>
                                
                                <li class="social-youtube" tooltip="YouTube" tooltip-placement="top">
                                    <a target="_blank" href="#">
                                        YouTube
                                    </a>
                                </li>
                                <li class="social-rss" tooltip="RSS" tooltip-placement="top">
                                    <a target="_blank" href="#">
                                        RSS
                                    </a>
                                </li>
                                <li class="social-skype" tooltip="Skype" tooltip-placement="top">
                                    <a target="_blank" href="#">
                                        Skype
                                    </a>
                                </li>
                                <li class="social-vk" tooltip="VK" tooltip-placement="top">
                                    <a target="_blank" href="#">
                                        VK
                                    </a>
                                </li>
                                <li class="social-instagram" tooltip="Instagram" tooltip-placement="top">
                                    <a target="_blank" href="#">
                                        Instagram
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 ">
                <div class="panel panel-transparent">
                    <div class="panel-heading">
                        <div class="panel-title">
                            Контакты
                        </div>
                    </div>
                    <div class="panel-body">
                        ООО " E-SERVICES HOUSE " инд.:100047, г.Ташкент, </br>
                        ул. Мирокилова д.57. (Ориентир: Педагогический институт, парк Бобура) </br>
                        р/с: 20208000604852928001 в ЧОАКБ «Asia Alliance Bank»  </br>
                        МФО 01057  ИНН: 301630964  ОКОНХ: 84200    </br>
                        +99871 281-44-71  <a href="mailto:#">info@websum.uz</a>
                        
                    </div>
                </div>
            </div>


        </div>
</div>     












</div> </div>


            
    </div>
    <!-- footer -->
    <?php $this->renderPartial('//layouts/_footer'); ?>
    <!-- footer end -->
</div>   
    
 
  

<div class='notifications top-right' id="notifications"></div>

<?php if (!Yii::app()->getUser()->isAuthenticated()): ?>
<?php $this->widget('application.modules.user.widgets.LoginWidget'); ?>
<?php endif; ?>



<?php
//$cs = Yii::app()->getClientScript();
//$cs->registerScriptFile('/js/deprecated.js');
//$this->widget('application.modules.core.extensions.fancybox.EFancyBox', array());
?>
<?php
  //echo CHtml::link('Войти', array('/login'), array('class'=>'fancy_auth'));                        
?>


<script>
/*$(document).ready(function(){
	$(".fancy_auth").fancybox({
        'transitionIn'      : 'elastic',
        'transitionOut'     : 'elastic',
        'width'             : 400,
        'height'            : 360,
        'autoDimensions': false,
        'autoSize': false,
        'speedIn'           : '500',
        'speedOut'          : '500',
        'type'              : 'ajax',
        'closeBtn' : false
});
});*/
</script>


<!-- Default Modal -->
	<div class="modal fade" id="forgot" tabindex="-1" role="dialog" aria-labelledby="forgotLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" style="background-color:#fff;">
				<div class="modal-body" >
<!-- start: FORGOT BOX -->
				<div class="box-forgot">
					<form class="form-forgot">
						<fieldset>
							<legend>
								Восстановить пароль
							</legend>
							<p>
								Введите ваш адрес электронной почты ниже, чтобы сбросить пароль.
							</p>
							<div class="form-group">
								<span class="input-icon">
									<input type="email" class="form-control" name="email" placeholder="Email">
									<i class="fa fa-envelope-o"></i> </span>
							</div>
							<div class="form-actions">
								<a class="btn btn-primary btn-o" data-toggle="modal" data-target="#myModal" data-dismiss="modal" aria-label="Close">
									<i class="fa fa-chevron-circle-left"></i> Вход
								</a>
								<button type="submit" class="btn btn-primary pull-right">
									Восстановить пароль <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</fieldset>
					</form>
				</div>
<!-- end: FORGOT BOX -->
				</div>
			</div>
		</div>
	</div>
<!-- /Default Modal -->

<!-- container end -->
<?php if (Yii::app()->hasModule('contentblock')): ?>
    <?php $this->widget(
        "application.modules.contentblock.widgets.ContentBlockWidget",
        ["code" => "STAT", "silent" => true]
    ); ?>
<?php endif; ?>


<!-- start: MAIN JAVASCRIPTS -->

		<script src="/js/vendor/modernizr/modernizr.js"></script>
		<script src="/js/vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="/js/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="/js/vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="/js/vendor/jquery.sparkline/jquery.sparkline.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="/js/index.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Index.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
<?php \core\components\TemplateEvent::fire(DefautThemeEvents::BODY_END);?>

</body>
</html>
