<?php

// change the following paths if necessary
$yii='../framework/yii.php';
$config=dirname(__FILE__).'/backend/protected/config/main.php';

// remove the following line when in production mode
// defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);
Yii::createWebApplication($config)->run();
