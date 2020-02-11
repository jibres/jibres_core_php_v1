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
			$myHeader = core.'engine/layout/pwa/pwa-header.php';
		}
		else
		{
			if(\dash\url::content() === 'enter')
			{
				// do nothing
			}
			elseif(\dash\url::content() === null)
			{
				$myHeader = root.'content/main/header.php';
			}
			elseif(\dash\data::include_adminPanel())
			{
				$myHeader = core.'engine/layout/admin/admin-header.php';
			}

		}

		if($myHeader)
		{
			echo "\n <header id='pageHeader' data-xhr='pageHeader'>";
			require_once $myHeader;
			echo "\n </header>";
		}
	}


	public static function footer()
	{
		$myFooter = null;
		if (\dash\detect\device::detectPWA())
		{
			// $myFooter = core.'engine/layout/pwa/pwa-footer.php';
		}
		else
		{
			if(\dash\url::content() === 'enter')
			{
				// do nothing
			}
			elseif(\dash\url::content() === null)
			{
				$myFooter = root.'content/main/footer.php';
			}
			elseif(\dash\data::include_adminPanel())
			{
				$myFooter = core.'engine/layout/admin/admin-footer.php';
			}

		}

		if($myFooter)
		{
			echo "\n <footer id='pageFooter' data-xhr='pageFooter'>";
			require_once $myFooter;
			echo "\n </footer>";
		}
	}
}
?>
