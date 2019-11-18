<?php
/**
 * default of all define
 */

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