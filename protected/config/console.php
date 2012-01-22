<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',
	// application components
	'components'=>array(
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		'CURL' =>array(
			'class' => 'application.extensions.curl.Curl',
     		//you can setup timeout,http_login,proxy,proxylogin,cookie, and setOPTIONS
     		'options' => array(
     			'setOptions'=>array(
         			CURLOPT_USERAGENT => 'Mozilla/6.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.13) Gecko/20080311 Firefox/2.0.0.13',
         			CURLOPT_SSL_VERIFYPEER=> false,
    			),
    		),
 		),
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
	),
);