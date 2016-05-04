<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'24好玩',
	'language'=>'zh_cn',  //此处根据你拷贝文件夹名自行设置  
	'charset'=>'utf-8',  //设置网站字符编码  
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
			// 'password'=>'shanyou@2015',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			// 'ipFilters'=>array('183.6.183.179','::1'),
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
			'errorAction'=>'site/error',
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
		// 'appid' =>'wxda1c54bdaa8eba24',
		// 'token' =>'i6rfzgeP0JIh11Rjbevz12fe',
		// 'appsecret' =>'e3ebc2dc1b8f289b4862e0e05a53da2c',
		// 'EncodingAESKey' => 'A5jbIE4YZHUrZihoAFAdK47jFoTxwNhWvVjAH5txmIr',
		// 'nonce' => 'dasd452knjvkf8',

		'appid' =>'wxfb7113e64f55b19a',
		// 'token' =>'i6rfzgeP0JIh11Rjbevz12fe',
		'appsecret' =>'0d344dd378006248b6ef59b5d5f2f55d',
		// 'EncodingAESKey' => 'A5jbIE4YZHUrZihoAFAdK47jFoTxwNhWvVjAH5txmIr',
		// 'nonce' => 'dasd452knjvkf8',
		// 'redirectUrl' => 'http%3A%2F%2Fh5-1.shanyougame.com%2Fmain%2Flogin%2F',
	),
);
