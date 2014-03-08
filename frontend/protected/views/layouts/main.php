<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="ipatov-soft">
    <?php
        Yii::app()->clientScript
         ->registerCoreScript('jquery') 
         ->registerMetaTag($this->pageMetaDescription, 'description') //meta
         ->registerMetaTag($this->pageMetaKeywords, 'keywords')
         //->registerLinkTag('alternate','application/rss+xml',$this->createUrl('feed/materials')) //link
         ->registerLinkTag('shortcut icon','image/png',$this->createUrl('/frontend/images/favicon.png')) //link
         ->registerCssFile(Yii::app()->request->baseUrl . '/frontend/css/bootstrap.min.css') //css
         ->registerCssFile(Yii::app()->request->baseUrl . '/frontend/wysibb/theme/default/wbbtheme.css') //css
         ->registerCssFile(Yii::app()->request->baseUrl . '/frontend/css/style.css') //css

         ->registerScriptFile(Yii::app()->request->baseUrl . '/frontend/js/bootstrap.min.js') //js
         ->registerScriptFile(Yii::app()->request->baseUrl . '/frontend/wysibb/jquery.wysibb.min.js') //js
         ->registerScriptFile(Yii::app()->request->baseUrl . '/frontend/js/main.js') //js
    ?>
     


	<title>
        <?= Yii::app()->params['title'] . ' - ' . CHtml::encode($this->pageTitle); ?>
    </title>
	
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5shiv.js"></script>
      <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/respond.min.js"></script>
    <![endif]-->
    <!-- vk -->
    <script type="text/javascript" src="http://vk.com/js/api/openapi.js?101"></script>
    <script type="text/javascript">
        VK.init({apiId: 3905878, onlyWidgets: true});
    </script>
</head>

<body>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter22446433 = new Ya.Metrika({id:22446433,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true});
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="//mc.yandex.ru/watch/22446433" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
<!--
    <div class="black_back"></div>
    <div class="message_case">
        <div class="aj_close">x</div>
        <div class="modal_message"></div>
    </div>
<!-- -->
    <!-- vk start -->
    <div class="container">
        <div class="row">
            <!-- Put this div tag to the place, where the Like block will be -->
            <div id="vk_like"></div>
            <script type="text/javascript">
            VK.Widgets.Like("vk_like", {type: "mini", height: 20});
            </script>
        </div>
    </div>
    <!-- vk end -->
    <div class="black_back"></div>
    <!-- black div end -->

    <div class="container general">
        <div class="row">
          <!-- -->
          <div class="col-md-3 schoolHeader">
              <div class="logo">
                <a href="/">
                  <img src="<?php echo Yii::app()->request->baseUrl; ?>/frontend/images/logo.png" alt="Grade School" />
                </a>
              </div>

                <!-- search -->
                <?php $this->widget('SearchField'); ?>
                <!-- userLeftInfo -->
                <?php $this->widget('LeftUserInfo'); ?>
                <!-- end userLeftInfo -->
                <?php  $this->widget('LoginzaWidget', array(
                    'params'=>array(
                        'return_url'=>'site/loginzalogin',
                        'logout_url'=>'site/logout',
                        'providers_set'=>array('google','vkontakte','facebook','twitter','rambler','openid','mailru','yandex','mailruapi'),
                    ),
                )); ?>
          </div>
          <!-- -->
          <div class="col-md-9">
              <!-- carousel start -->
                <?php if($this->beginCache('HeaderCarousel', array('duration'=>3600))) { ?>
                    <?php $this->widget('HeaderCarousel'); ?>
                <?php $this->endCache(); } ?>
              <!-- carousel end -->
          </div>
          <!-- -->
        </div>
    </div>
    <!-- header end -->
    <div class="container">
        <!-- -->
        <div class="row siteContentCase">
            <!-- blue back -->
            <div class="col-md-3 leftVerticalColumn"></div>
            <!-- end blue back -->
            <div class="col-md-3 leftVerticalMenu">
                <!-- left menu -->                            
                <?php $this->widget('LeftMenu') ?>
                <!-- vote -->
                <?php $this->widget('UserVote'); ?>
                <!-- left news -->                        
                <?php if($this->beginCache('LeftNews', array('duration'=>3600))) { ?>
                    <?php $this->widget('LeftNews'); ?>
                <?php $this->endCache(); } ?>
            </div>
            <!-- content -->
            <div class="col-md-9 site_content_column">
                <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                    'homeLink'=>CHtml::link('Главная',array('site/index')),
                    'links'=>$this->breadcrumbs,
                )); ?>
                <!-- -->
                <?php echo $content; ?>
                <!-- -->
            </div>
        </div>
        <!-- -->
    </div>
    <!-- footer -->
    <div id="footer" class="container">
      <div class="row">
        <!-- -->
        <div class="col-md-6 copyRight">
            Copyright <?= CHtml::link('&copy; ipatov-soft.ru', 'http://ipatov-soft.ru/'); ?>
            2012 - <?php echo date('Y')?> 

        </div>
        <!-- -->
        <div class="col-md-6 navbar-collapse collapse">
        <?php 
            $this->widget('zii.widgets.CMenu',array(
                'htmlOptions'=>array('class'=>'nav navbar-nav navbar-right'),
                'items'=>array(
                    array('label'=>'Политика конфиденциальности', 'url' => array('about/view', 'id'=>2, 'pageUrl'=>'privacy_policy')),
                    array('label'=>'О сайте', 'url' => array('about/view', 'id'=>1, 'pageUrl'=>'about')),
                    array('label'=>'Контакты', 'url'=>array('site/contact')),
                )));
        ?>
        </div>
      </div>
    </div>
    <div class="row"></div>
    <!-- end footer -->

    <!-- scroll top -->
    <div class="btn btn-primary btn-lg scrollTopButton">
        <span class="glyphicon glyphicon-chevron-up"></span>
    </div>
    <!-- end scroll top -->
    
</body>
</html>