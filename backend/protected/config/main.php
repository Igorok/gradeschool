<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'First school admin panel',
	
	/*
	'modules'=>array(
			'gii'=>array(
				'class'=>'system.gii.GiiModule',
				'password'=>'1',
				// 'ipFilters'=>array(…список IP…),
				// 'newFileMode'=>0666,
				// 'newDirMode'=>0777,
			),
		),
	*/
    
    
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'defaultController'=>'home',

	// application components
	'components'=>array(
		'ih'=>array('class'=>'CImageHandler'),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=oeid8237_school',
            'emulatePrepare' => true,
			'username' => 'root',
			'password' => '123',
			// 'username' => 'school',
			// 'password' => '7xjmma5v5m',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		
		
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				
				// array(
					// 'class'=>'CWebLogRoute',
                    // 'levels'=>'error, warning, trace, info',
				// ),
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);