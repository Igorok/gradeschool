<!DOCTYPE html>
<html>
    
    <head>
        
		<!-- blueprint CSS framework -->
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/frontend/css/screen.css" media="screen, projection" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/frontend/css/print.css" media="print" />
		<!--[if lt IE 8]>
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
		<![endif]-->
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/frontend/css/main.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/frontend/css/form.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/backend/css/styles.css" />
		<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
		<?php  
			$baseUrl = Yii::app()->baseUrl; 
			$cs = Yii::app()->getClientScript();
			$cs->registerCssFile($baseUrl.'/backend/css/bootstrap.css');
			$cs->registerCssFile($baseUrl.'/backend/css/bootstrap-responsive.css');
			$cs->registerScriptFile($baseUrl.'/backend/js/modernizr-2.6.2-respond-1.1.0.min.js');
			$cs->registerScriptFile($baseUrl.'/backend/js/bootstrap.js');
			$cs->registerScriptFile($baseUrl.'/backend/js/main.js');
			
		?>
		
        <!-- Bootstrap -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    
    <body id="login">
    <div class="container">
	  <div class="form-signin">
		<?php echo $content; ?>
	  </div>
    </div> <!-- /container -->
  </body>

</html>
