<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'咕噜咕噜',
	'defaultController'=>'main',
	// 'defaultController'=>'check',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'shanyou@2015',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('183.6.183.179','::1'),
		),
		
	),

	// application components
	'components'=>array(

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
			'showScriptName'=>false,
		),
		

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'main/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		// 'token' =>'i6rfzgeP0JIh11Rjbevz12fe',
		// 'appid' =>'wxda1c54bdaa8eba24',
		// 'appsecret' =>'e3ebc2dc1b8f289b4862e0e05a53da2c',
		'token' =>'glgl9game2shanyou',
		'appid' =>'wxef721b05e2002815',
		'appsecret' =>'e69130dc6b401f64e9684f0f00ec8170',
		'EncodingAESKey' => 'kEEIWRJmbkZmX3EbIsY4QMpnAYcJMXC32BI1ZJXieVH',
		'nonce' => 'dasd452knjvkf8',
	),
);
