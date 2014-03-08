<!DOCTYPE html>
<html>
    
    <head>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
		<!-- blueprint CSS framework -->
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/frontend/css/screen.css" media="screen, projection" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/frontend/css/print.css" media="print" />
		<!--[if lt IE 8]>
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
		<![endif]-->
		<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
		<?php  
			$baseUrl = Yii::app()->baseUrl; 
			$cs = Yii::app()->getClientScript();
			$cs->registerCssFile($baseUrl.'/backend/css/main.css');
			$cs->registerCssFile($baseUrl.'/backend/css/form.css');
			$cs->registerCssFile($baseUrl.'/backend/css/bootstrap.css');
			$cs->registerCssFile($baseUrl.'/backend/css/bootstrap-responsive.css');
			$cs->registerCssFile($baseUrl.'/backend/css/styles.css');
			$cs->registerScriptFile($baseUrl . '/backend/js/modernizr-2.6.2-respond-1.1.0.min.js');
			$cs->registerScriptFile($baseUrl.'/backend/js/bootstrap.js');
            $cs->registerCssFile($baseUrl.'/frontend/wysibb/theme/default/wbbtheme.css');   $cs->registerScriptFile($baseUrl.'/frontend/wysibb/jquery.wysibb.min.js');
			$cs->registerScriptFile($baseUrl.'/backend/js/main.js');
			
		?>
		
        <!-- Bootstrap -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
					<?php echo CHtml::link('Admin Panel',array('home/index'),array('class'=>'brand')); ?>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> <?php echo Yii::app()->user->name ?> <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <?php echo CHtml::link('Пользователи',array('user/admin')); ?>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <?php echo CHtml::link('Выход',array('site/logout')); ?>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <!-- header menu -->
                        <ul class="nav">
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Посты <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <li>
										<?php echo CHtml::link('Категории постов',array('postcategory/admin')); ?>
									</li>
                                    <li>
										<?php echo CHtml::link('Управление постами',array('post/admin')); ?>
									</li>
                                    <li>
										<?php echo CHtml::link('Все посты',array('post/index')); ?>
									</li>
									<li>
										<?php echo CHtml::link('Одобренные посты',array('post/approved?statId=1')); ?>
									</li>
									<li>
										<?php echo CHtml::link('Посты на одобрении',array('post/approved?statId=3')); ?>
									</li>
                                    <li>
										<?php echo CHtml::link('Не одобренные посты',array('post/approved?statId=2')); ?>
									</li>
                                </ul>
                            </li>
                            <!-- users -->
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Пользователи <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <li>
										<?php echo CHtml::link('Управление пользователями',array('user/admin')); ?>
									</li>
                                    <li>
										<?php echo CHtml::link('Все пользователи',array('user/index')); ?>
									</li>
									<li>
										<?php echo CHtml::link('Действующие пользователи',array('user/approved?statId=1')); ?>
									</li>
									<li>
										<?php echo CHtml::link('Заблокированные пользователи',array('user/approved?statId=2')); ?>
									</li>
                                </ul>
                            </li>
                            <!-- vote -->
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Голосование <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <li>
										<?php echo CHtml::link('Управление вопросами',array('voteQuestion/admin')); ?>
									</li>
                                    <li>
										<?php echo CHtml::link('Управление ответами',array('voteAnswer/admin')); ?>
									</li>
                                </ul>
                            </li>
                            <!-- -->
                        </ul>
                        <!-- end header menu -->
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container-fluid ips_admin_main">
            <div class="row-fluid">
                <div class="span3" id="sidebar">
                    <?php $this->widget('zii.widgets.CMenu', array(
						'htmlOptions' => array( 'class' => 'nav nav-list bs-docs-sidenav nav-collapse collapse'),
						'items'=>array(
							array('label'=>'Панель управления ('.Yii::app()->user->name.')', 'url'=>array('home/index'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'О сайте', 'url'=>array('about/admin')),
                            array('label'=>'Новости', 'url'=>array('news/admin')),
                            array('label'=>'Категории видео', 'url'=>array('videocategory/admin')),
							array('label'=>'Видео', 'url'=>array('video/admin')),
							array('label'=>'Категории аудио', 'url'=>array('audiocategory/admin')),
							array('label'=>'Аудио', 'url'=>array('audio/admin')),
							array('label'=>'Категории картинок', 'url'=>array('imagecategory/admin')),
							array('label'=>'Картинки', 'url'=>array('image/admin')),
                            array('label'=>'Статусы', 'url'=>array('status/admin')),
							array('label'=>'Администраторы', 'url'=>array('useradmin/admin')),
						),						
					)); ?>
                </div>
                
                
                <!--/span-->
                <div class="span9" id="content">
                    <?php echo $content; ?>
                </div>
            </div>
            <hr>
            <footer>
                <p>Copyright &copy; 2012 - <?php echo date('Y'); ?> www.ipatov-soft.ru</p>
            </footer>
        </div>
        <!--/.fluid-container-->
		
    </body>

</html>
