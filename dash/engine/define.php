<?php
/**
 * default of all define
 */

function cronjob_server()
{
	// cun cronjob by this code
	// php /home/reza/projects/jibres/public_html/index.php '{"trust_token":"123","HTTP_HOST":"mohiti.jibres.local","SERVER_NAME":"jibres.local","SERVER_PORT":"80","SERVER_PROTOCOL":"HTTP/1.1","REQUEST_URI":"/a","REQUEST_METHOD":"POST","SCRIPT_FILENAME":"/home/reza/projects/jibres/public_html/index.php"}' &
	if(!isset($GLOBALS['argv'][1]))
	{
		return false;
	}

	$newServer = $GLOBALS['argv'][1];
	if(!is_string($newServer))
	{
		return false;
	}

	$newServer = json_decode($newServer, true);
	if(!is_array($newServer))
	{
		return false;
	}

	$trust_addr = __DIR__. '/cronjob_server.me.token';
	if(!is_file($trust_addr))
	{
		return false;
	}

	$load_token = file_get_contents($trust_addr);
	if(isset($newServer['trust_token']) && $newServer['trust_token'] === $load_token)
	{
		$_SERVER = $newServer;
	}
	else
	{
		// invalid token
		// be not continue
		exit();
	}
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

?>