<?php
namespace dash\engine;
/**
 * dash main configure
 */
class template_engine
{
	public static function shoot()
	{
		$nativeTemplate = \autoload::fix_os_path(root. ltrim(\dash\engine\mvc::get_dir_address().'\display.php', '\\'));

		if(is_file($nativeTemplate))
		{
			require_once core.'engine\layout\Foundation.php';
			return true;
		}

		return false;
	}

	public static function find($_what)
	{

	}


	public static function header()
	{
		$myHeader = null;
		if (\dash\detect\device::detectPWA())
		{
			$myHeader = core.'engine/layout/pwa-header.php';
		}
		elseif(\dash\data::include_adminPanel())
		{
			$myHeader = core.'engine/layout/admin-header.php';
		}
		else
		{
			$myHeader = root.'content/main/header.php';
		}

		if($myHeader)
		{
			echo "\n <header id='pageHeader' data-xhr='pageHeader'>";
			require_once $myHeader;
			echo "\n </header>";
		}
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
