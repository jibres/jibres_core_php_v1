<?php
namespace dash\engine\layout;
/**
 * dash main configure
 */
class find
{
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
		elseif(\dash\url::content() === 'enter')
		{
			// do nothing
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
}
?>
