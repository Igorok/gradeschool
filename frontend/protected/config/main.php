<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Начальная школа',
	
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

	'defaultController'=>'site',

	// application components
	'components'=>array(
		'ih'=>array('class'=>'CImageHandler'),

		'cache'=>array('class'=>'system.caching.CFileCache'),
		//'cache'=>array('class'=>'system.caching.CDummyCache'),
		
		'search' => array(
            'class' => 'application.components.DGSphinxSearch',
            'server' => '127.0.0.1',
            'port' => 9312,
            'maxQueryTime' => 3000,
            'enableProfiling'=>0,
            'enableResultTrace'=>0,
        ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		
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
			'showScriptName'=>false,
			'urlFormat'=>'path',
			'rules'=>array(
				'postcategory/<id:\d+>/<pageUrl:.*?>'=>'postcategory/view',
				'audiocategory/<id:\d+>/<pageUrl:.*?>'=>'audiocategory/view',
				'videocategory/<id:\d+>/<pageUrl:.*?>'=>'videocategory/view',
				'imagecategory/<id:\d+>/<pageUrl:.*?>'=>'imagecategory/view',
				'post/view/<id>'=>'post/view',
				'news/<id:\d+>/<pageUrl:.*?>'=>'news/view',
				'about/<id:\d+>/<pageUrl:.*?>'=>'about/view',
				'image/<id:\d+>/<pageUrl:.*?>'=>'image/view',
				'audio/<id:\d+>/<pageUrl:.*?>'=>'audio/view',
				'video/<id:\d+>/<pageUrl:.*?>'=>'video/view',
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
				
				array(
					'class'=>'CWebLogRoute',
                    'levels'=>'error, warning, trace, info',
				),
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);
