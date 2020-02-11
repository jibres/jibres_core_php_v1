<?php
namespace dash\engine\layout;
/**
 * dash main configure
 */
class fn
{
	private static $DISPLAY = null;


	public static function shoot()
	{
		$nativeTemplate = \autoload::fix_os_path(root. ltrim(\dash\engine\mvc::get_dir_address().'\display.php', '\\'));

		if(is_file($nativeTemplate))
		{
			self::$DISPLAY = $nativeTemplate;
			require_once core.'engine/layout/foundation.php';
			return true;
		}

		return false;
	}


	public static function display()
	{
		return self::$DISPLAY;
	}

	public static function staticmtime($_fileAddr)
	{
		$result       = $_fileAddr;
		$lastTime     = null;
		$complete_url = root.'public_html/static/'. $_fileAddr;
		if($_fileAddr && \dash\file::exists($complete_url))
		{
			$lastTime = filemtime($complete_url);
		}

		if($lastTime)
		{
			$result .= '?'. $lastTime;
		}

		return \dash\url::static(). '/'. $result;
	}
}
?>
