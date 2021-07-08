<?php
/**
 * default of all define
 */

function cronjob_server()
{

	// cun cronjob by this code
	// php /home/reza/projects/jibres/public_html/index.php php_run_jibres_cronjob &
	if(!isset($GLOBALS['argv'][1]))
	{
		return false;
	}

	$argv = $GLOBALS['argv'][1];
	if(!is_string($argv))
	{
		return false;
	}


	if(!isset($GLOBALS['argv'][2]))
	{
		return false;
	}

	$SCRIPT_FILENAME = $GLOBALS['argv'][2];
	if(!is_string($SCRIPT_FILENAME))
	{
		return false;
	}

	if(!in_array($argv, ['php_run_jibres_cronjob', 'php_run_business_cronjob_once', 'php_run_business_cronjob_force']))
	{
		return false;
	}

	$newServer =
	[
		'HTTP_HOST'       => 'jibres.ir',
		'SERVER_NAME'     => 'jibres.ir',
		'SERVER_PORT'     => '443',
		'SERVER_PROTOCOL' => 'HTTP/1.1',
		'REQUEST_URI'     => '/hook/job',
		'REQUEST_METHOD'  => 'POST',
		'SERVER_ADDR'     => '1.1.1.1',
		'REMOTE_ADDR'     => '1.1.1.1',
		'HTTP_USER_AGENT' => 'Jibres-cronjob',
		'HTTP_COOKIE'     => 'Jibres-cronjob-cookie',
		'SCRIPT_FILENAME' => $SCRIPT_FILENAME,
	];


	$_SERVER = $newServer;
	// define iscronjob
	define('ISCRONJOB', true);

	define('CRONJOB_MODE', $argv);

}


/**
 * Find $_SERVER !
 */
cronjob_server();

// Define Global variables ****************************************************
// Core name
define('core_name', 'dash');


// Define Dash variables ****************************************************
$dir = __DIR__;
$dir = str_replace('\\', '/', $dir);
$dir = str_replace('/engine', '', $dir);
define("core", preg_replace("[\\\\]", "/", $dir).'/' );


// Define Project variables ***************************************************
define("root", dirname(dirname($_SERVER['SCRIPT_FILENAME'])).'/' );


// define yard folder of project *********************************************
define('YARD', substr(root, 0,-7));


set_include_path(get_include_path() . PATH_SEPARATOR . root.'includes/');
set_include_path(get_include_path() . PATH_SEPARATOR . core);



// Project database
define("database", root.'includes/database/');

// Set default timezone to Asia/Tehran, Please set timezone in your php.ini
if(defined("timezone"))
{
	date_default_timezone_set(constant('timezone'));
}
else
{
	date_default_timezone_set('Asia/Tehran');
}


// if personal config exist, require it
if(file_exists(root .'config.me.php'))
{
	require_once(root .'config.me.php');
}

// define a to check array and
function a()
{
	return \dash\get::index(...func_get_args());
}

?>