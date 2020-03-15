<?php
namespace dash\layout;
/**
 * dash main configure
 */
class func
{
	private static $DISPLAY = null;


	public static function shoot()
	{
		$nativeTemplate = \dash\engine\mvc::get_dir_address();

		// load template contain filename and needless to add display.php of end of addr
		if(substr($nativeTemplate, -4) !== '.php')
		{
			$nativeTemplate = $nativeTemplate. '\\display.php';
		}

		$nativeTemplate = ltrim($nativeTemplate, '\\');
		$nativeTemplate = root. $nativeTemplate;
		$nativeTemplate = \autoload::fix_os_path($nativeTemplate);

		if(is_file($nativeTemplate))
		{
			self::$DISPLAY = $nativeTemplate;

			if(\dash\request::ajax())
			{
				// read all notif
				$notifs = \dash\notif::get();
				if($notifs)
				{
					\dash\data::global_debug(\dash\notif::get());
				}
				// send global on line1 of xhr
				echo json_encode(\dash\data::get('global'),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES). "\n";
				// create all blocks
				\dash\layout\find::allBlocks();
				\dash\layout\find::pageScript();
			}
			else
			{
				// read main foundation file
				require_once core.'/layout/foundation.php';
			}
			// it's okay, dont run Twig!
			return true;
		}

		return false;
	}


	public static function display()
	{
		return self::$DISPLAY;
	}


	public static function script_addr()
	{
		return str_replace('display.php', 'script.js', self::$DISPLAY);
	}


	public static function staticmtime($_fileAddr)
	{
		$result       = $_fileAddr;
		$lastTime     = null;
		$complete_url = YARD.'talambar_cdn/'. $_fileAddr;
		if($_fileAddr && \dash\file::exists($complete_url))
		{
			$lastTime = filemtime($complete_url);
		}

		if($lastTime)
		{
			$result .= '?'. $lastTime;
		}

		return \dash\url::cdn(). '/'. $result;
	}
}
?>
