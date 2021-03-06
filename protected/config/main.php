<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'',

	// preloading 'log' component
	'preload'=>array(
        'log',
        'bootstrap',
        'mail',
    ),

    //  Aplly Theme
    'theme'=>'bootstrap',

    // set timezone
    'timeZone'=>"Asia/Saigon",

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.extensions.*',
        'ext.bootstrap.*',
        'ext.yii-mail.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Abc123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
            'generatorPaths' => array(
                'bootstrap.gii'
            ),
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
            'showScriptName'=>'false',
		),

        'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),

		/*
		 'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		 ),
		*/
		// uncomment the following to use a MySQL database

		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=ems',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
            'enableProfiling'=>true,
            'enableParamLogging'=>true,
		),

        /* DB Non Relationship
        'db'=>array(
            'connectionString' => 'mysql:host=127.0.0.1;dbname=nonems',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'enableProfiling'=>true,
            'enableParamLogging'=>true,
        ),
        */

        'authManager'=>array(
            'class'=>'CDbAuthManager',
            'connectionID'=>'db',
        ),

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
		'mail' => array(
            'class' => 'ext.yii-mail.YiiMail',
            'transportType' => 'smtp', // change to 'php' when running in real domain.
            'viewPath' => 'application.views.mail',
            'logging' => true,
            'dryRun' => false,
            'transportOptions' => array(
                'host' => 'smtp.gmail.com',
                'username' => 'noreply.ems.project@gmail.com',
                'password' => 'pw-intern-2013',
                'port' => '465',
                'encryption' => 'ssl',
            )
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'adm.ems.project@gmail.com',
        'adminName' => 'EMS System',
        'noreplyEmail' => 'noreply.ems.project@gmail.com',
        'noreplyName' => 'Noreply',
        'pageSize' => '20',
	),
);