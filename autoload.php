<?php

// save engine start time
define('ENGINE_START_TIME', microtime(true));

/**
 * require default define
 */
require_once (__DIR__. '/dash/engine/define.php');


class autoload
{
	private static $required = [];


	public static function load($_class_name)
	{
		if(isset(self::$required[$_class_name]))
		{
			return;
		}

		if(substr($_class_name, 0, 4) === 'dash')
		{
			$addr = core;
			$addr = $addr. substr($_class_name, 4); // str_replace('dash', '', $_class_name);
			$addr = self::fix_os_path($addr);

			if(self::open($addr))
			{
				self::$required[$_class_name] = true;
			}
		}
		elseif(substr($_class_name, 0, 7) === 'content' || substr($_class_name, 0, 10) === 'enterprise')
		{
			$addr = root. $_class_name;
			$addr = self::fix_os_path($addr);

			if(self::open($addr))
			{
				self::$required[$_class_name] = true;
			}
		}
		elseif(substr($_class_name, 0, 3) === 'lib')
		{
			$addr = root. $_class_name;
			$addr = self::fix_os_path($addr);

			if(self::open($addr))
			{
				self::$required[$_class_name] = true;
			}
		}
	}


	private static function open($_addr)
	{
		// add php ext to addr
		$_addr = $_addr. '.php';

		if(is_file($_addr))
		{
			include_once($_addr);
			return true;
		}
		return false;
	}


	public static function fix_os_path($_addr)
	{
		$_addr = str_replace('\\', DIRECTORY_SEPARATOR, $_addr);
		$_addr = str_replace('/', DIRECTORY_SEPARATOR, $_addr);
		$_addr = str_replace(DIRECTORY_SEPARATOR. DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, $_addr);
		return $_addr;
	}
}

spl_autoload_register("\autoload::load");

// LAUNCH DASH!
\dash\engine\power::on();
?>
