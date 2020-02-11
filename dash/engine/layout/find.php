<?php
namespace dash\engine\layout;
/**
 * dash main configure
 */
class find
{
	private static $need_box = null;


	public static function main()
	{
		$myPage = null;
		if (\dash\detect\device::detectPWA())
		{
			// $myPage = core.'engine/layout/pwa/pwa-main.php';
		}
		else
		{
			if(\dash\url::content() === 'enter')
			{
				// do nothing
			}
			elseif(\dash\url::content() === null)
			{
				// $myPage = root.'content/main/main.php';
			}
			elseif(\dash\data::include_adminPanel())
			{
				// $myPage = core.'engine/layout/admin/admin-main.php';
			}
		}

		if($myPage)
		{
			echo "\n <main id='pageContent' data-xhr='pageContent'>";
			require_once $myPage;
			echo "\n </main>";
		}
	}

	public static function header()
	{
		$myPage = null;
		if (\dash\detect\device::detectPWA())
		{
			$myPage = core.'engine/layout/pwa/pwa-header.php';
		}
		else
		{
			if(\dash\url::content() === 'enter')
			{
				// do nothing
			}
			elseif(\dash\url::content() === null)
			{
				$myPage = root.'content/main/header.php';
			}
			elseif(\dash\data::include_adminPanel())
			{
				$myPage = core.'engine/layout/admin/admin-header.php';
			}

		}

		if($myPage)
		{
			self::$need_box = true;
			echo "\n <header id='pageHeader' data-xhr='pageHeader'>";
			require_once $myPage;
			echo "\n </header>";
		}
	}


	public static function footer()
	{
		$myPage = null;
		if (\dash\detect\device::detectPWA())
		{
			// $myPage = core.'engine/layout/pwa/pwa-footer.php';
		}
		else
		{
			if(\dash\url::content() === 'enter')
			{
				// do nothing
			}
			elseif(\dash\url::content() === null)
			{
				$myPage = root.'content/main/footer.php';
			}
			elseif(\dash\data::include_adminPanel())
			{
				$myPage = core.'engine/layout/admin/admin-footer.php';
			}

		}

		if($myPage)
		{
			echo "\n <footer id='pageFooter' data-xhr='pageFooter'>";
			require_once $myPage;
			echo "\n </footer>";
		}
	}



	public static function sidebar()
	{
		$myPage = null;
		if (\dash\detect\device::detectPWA())
		{
			// $myPage = core.'engine/layout/pwa/pwa-sidebar.php';
		}
		else
		{
			if(\dash\url::content() === 'enter')
			{
				// do nothing
			}
			elseif(\dash\url::content() === null)
			{
				// do nothing
			}
			elseif(\dash\data::include_adminPanel())
			{
				$myPage = core.'engine/layout/admin/admin-sidebar.php';
			}

		}

		if($myPage)
		{
			echo "\n <aside id='pageSidebar' data-xhr='pageSidebar'>";
			require_once $myPage;
			echo "\n </aside>";
		}
	}

	public static function nav()
	{
		$myPage = null;
		// do nothing

		if($myPage)
		{
			echo "\n <nav id='pageNav' data-xhr='pageNav'>";
			require_once $myPage;
			echo "\n </nav>";
		}
	}

	public static function box($_mode)
	{
		if(self::$need_box)
		{
			if($_mode === 'start')
			{
				echo "\n <div id='pageWrapper' data-xhr='pageWrapper'>";
			}
			else
			{
				echo "\n </div>";
			}
		}
	}

}
?>
