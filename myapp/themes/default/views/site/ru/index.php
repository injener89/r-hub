<?php $this->pageTitle = Yii::app()->getModule('core')->siteName;?>
<?php $this->widget('core\widgets\YFlashMessages'); ?>




<div class="slider-wrapper">
    <div class="responisve-container">
        <div class="slider">
            <div class="fs_loader"></div>
            <div class="slide">
                <!--<img    src="images/01_box_top.png"
                        width="361" height="354"
                        data-position="-152,142" data-in="left" data-delay="200" data-out="right">

                <img    src="images/01_box_bottom.png"
                        width="422" height="454"
                        data-position="138,-152" data-in="bottomRight" data-delay="200">

                <img    src="images/01_waves.png"
                        width="1449" height="115"
                        data-position="240,17" data-in="left" data-delay="" data-out="left">

                        data-ease-in="easeOutBounce" data-delay="100"
                        -->

                <p      class="claim"
                          data-position="50,300" data-in="top" data-step="1" data-out="right" >Мобильное приложение</p>

                <p      class="teaser"
                          data-position="90,300" data-in="left" data-step="2" data-out="right" ><span id="websum">WEBSUM</span> для iOS</p>
                <p      class="teaser"
                          data-position="200,380" data-in="left" data-step="3" data-out="right" >
                          <a href="#" id="mone_slide">Подробнее</a>
                          <a href="#" id="download_slide">Скачать</a>
                          </p>
                <!-- <p         class="teaser green"
                           data-position="90,30" data-in="left" data-step="2" data-special="cycle" data-delay="3000">full control over each element</p>
                 <p         class="teaser turky"
                           data-position="90,30" data-in="left" data-step="2" data-special="cycle" data-delay="5500" data-out="none">opensource and free</p>-->

                <img    src="/images/iphone_new.PNG"
                        data-position="50,30" data-in="right" data-delay="200" data-out="left" style="width:auto; height:auto">

            </div>
            <div class="slide">
                <!--<img    src="images/01_box_top.png"
                        width="361" height="354"
                        data-position="-152,142" data-in="left" data-delay="200" data-out="right">

                <img    src="images/01_box_bottom.png"
                        width="422" height="454"
                        data-position="138,-152" data-in="bottomRight" data-delay="200">

                <img    src="images/01_waves.png"
                        width="1449" height="115"
                        data-position="240,17" data-in="left" data-delay="" data-out="left">-->

                <p      class="claim"
                          data-position="50,300" data-in="top" data-step="1" data-out="right" >Мобильное приложение</p>

                <p      class="teaser"
                          data-position="90,300" data-in="left" data-step="2" data-out="right" ><span id="websum">WEBSUM</span> для iOS</p>
                <p      class="teaser"
                          data-position="200,380" data-in="left" data-step="3" data-out="right" >
                          <a href="#" id="mone_slide">Подробнее</a>
                          <a href="#" id="download_slide">Скачать</a>
                          </p>
                <!-- <p         class="teaser green"
                           data-position="90,30" data-in="left" data-step="2" data-special="cycle" data-delay="3000">full control over each element</p>
                 <p         class="teaser turky"
                           data-position="90,30" data-in="left" data-step="2" data-special="cycle" data-delay="5500" data-out="none">opensource and free</p>-->

                <img    src="/images/iphone_new.PNG"
                        data-position="50,30" data-in="right" data-delay="200" data-out="left" style="width:auto; height:auto">

            </div>
            <div class="slide">
                <!--<img    src="images/01_box_top.png"
                        width="361" height="354"
                        data-position="-152,142" data-in="left" data-delay="200" data-out="right">

                <img    src="images/01_box_bottom.png"
                        width="422" height="454"
                        data-position="138,-152" data-in="bottomRight" data-delay="200">

                <img    src="images/01_waves.png"
                        width="1449" height="115"
                        data-position="240,17" data-in="left" data-delay="" data-out="left">-->

                <p      class="claim"
                          data-position="50,300" data-in="top" data-step="1" data-out="right" >Мобильное приложение</p>

                <p      class="teaser"
                          data-position="90,300" data-in="left" data-step="2" data-out="right" ><span id="websum">WEBSUM</span> для iOS</p>
                <p      class="teaser"
                          data-position="200,380" data-in="left" data-step="3" data-out="right" >
                          <a href="#" id="mone_slide">Подробнее</a>
                          <a href="#" id="download_slide">Скачать</a>
                          </p>
                <!-- <p         class="teaser green"
                           data-position="90,30" data-in="left" data-step="2" data-special="cycle" data-delay="3000">full control over each element</p>
                 <p         class="teaser turky"
                           data-position="90,30" data-in="left" data-step="2" data-special="cycle" data-delay="5500" data-out="none">opensource and free</p>-->

                <img    src="/images/iphone_new.PNG"
                        data-position="50,30" data-in="right" data-delay="200" data-out="left" style="width:auto; height:auto">

            </div>

        </div>
    </div>
</div>

		




            <?php if (!Yii::app()->getUser()->isAuthenticated()): ?>
                    <?php //$this->widget('application.modules.user.widgets.LoginWidget'); ?>
            <?php endif; ?>
            <?php if (Yii::app()->getUser()->isAuthenticated()): ?>
                    <?php //$this->widget('application.modules.user.widgets.ProfileWidget'); ?>
            <?php endif; ?>
            <?php //$this->renderPartial('//layouts/_contact'); ?>
           <?php //$this->widget('application.modules.news.widgets.LastNewsWidget'); ?>

