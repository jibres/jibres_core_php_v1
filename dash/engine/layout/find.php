<?php
namespace dash\engine\layout;
/**
 * dash main configure
 */
class find
{

	public static function allBlocks()
	{
		self::sidebar();
		self::header();
		// self::nav();
		self::main();
		self::footer();

	}


	public static function main()
	{
		$myPage = null;
		if (\dash\detect\device::detectPWA() && false)
		{
			// $myPage = core.'engine/layout/pwa/pwa-main.php';
		}
		else
		{
			if(\dash\url::content() === 'enter')
			{
				$myPage = root.'content_enter/home/layout/main.php';
				// do nothing
			}
			elseif(\dash\url::content() === null)
			{
				$myPage = root.'content/home/layout/main.php';
			}
			elseif(\dash\data::include_adminPanel())
			{
				$myPage = core.'engine/layout/admin/admin-main.php';
			}
		}

		if($myPage !== null)
		{
			echo "\n <main id='pageContent' data-xhr='pageContent'>";
			if($myPage)
			{
				require_once $myPage;
			}
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
				$myPage = root.'content/home/layout/header.php';
			}
			elseif(\dash\data::include_adminPanel())
			{
				$myPage = core.'engine/layout/admin/admin-header.php';
			}

		}

		echo "\n  <header id='pageHeader' data-xhr='pageHeader'>";
		if($myPage)
		{
			require_once $myPage;
			echo "\n  ";
		}
		echo "</header>";
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
				$myPage = root.'content/home/layout/footer.php';
			}
			elseif(\dash\data::include_adminPanel())
			{
				// do nothing
				// $myPage = core.'engine/layout/admin/admin-footer.php';
			}

		}

		echo "\n  <footer id='pageFooter' data-xhr='pageFooter'>";
		if($myPage)
		{
			require_once $myPage;
			echo "\n  ";
		}
		echo "</footer>";
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

		echo "\n <aside id='pageSidebar' data-xhr='pageSidebar'>";
		if($myPage)
		{
			require_once $myPage;
			echo "\n";
		}
		echo "</aside>";
	}


	public static function nav()
	{
		$myPage = null;
		// do nothing

		if($myPage !== null)
		{
			echo "\n <nav id='pageNav' data-xhr='pageNav'>";
			if($myPage)
			{
				require_once $myPage;
			}
			echo "\n </nav>";
		}
	}
}
?>
