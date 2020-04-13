<?php
namespace dash\layout;
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

		if(\dash\url::content() === 'enter')
		{
			$myPage = root.'content_enter/home/layout/main.php';
			// do nothing
		}
		elseif(\dash\engine\content::get() === 'content_subdomain')
		{
			// do nothing
		}
		elseif(\dash\url::content() === null)
		{
			$myPage = root.'content/home/layout/main.php';
		}
		elseif(\dash\data::include_adminPanel())
		{
			$myPage = core.'layout/admin/admin-main.php';
		}

		if($myPage !== null || \dash\layout\func::display())
		{
			echo "\n <main id='pageContent' data-xhr='pageContent'>";
			if($myPage)
			{
				require_once $myPage;
			}
			elseif (\dash\layout\func::display())
			{
				require_once \dash\layout\func::display();
			}
			echo "\n </main>";
		}
	}


	public static function header()
	{
		$myPage = null;
		if (\dash\detect\device::detectPWA())
		{
			$myPage = core.'layout/pwa/pwa-header.php';
		}
		else
		{
			if(\dash\url::content() === 'enter')
			{
				// do nothing
			}
			elseif(\dash\engine\content::get() === 'content_subdomain')
			{
				$myPage = root.'content_subdomain/home/layout/header.php';
			}
			elseif(\dash\url::content() === null)
			{
				$myPage = root.'content/home/layout/header.php';
			}
			elseif(\dash\data::include_adminPanel())
			{
				$myPage = core.'layout/admin/admin-header.php';
			}

		}

		echo "\n  <header id='pageHeader' data-xhr='pageHeader' data-scroll>";
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
			$myPage = core.'layout/pwa/pwa-footer.php';
		}
		else
		{
			if(\dash\url::content() === 'enter')
			{
				// do nothing
			}
			elseif(\dash\engine\content::get() === 'content_subdomain')
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
				// $myPage = core.'layout/admin/admin-footer.php';
			}

		}

		echo "\n  <footer id='pageFooter' data-xhr='pageFooter'>";
		if($myPage)
		{
			require_once $myPage;
		}
		echo "</footer>";
	}


	public static function sidebar()
	{
		$myPage = null;
		if (\dash\detect\device::detectPWA())
		{
			// $myPage = core.'layout/pwa/pwa-sidebar.php';
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
				$myPage = core.'layout/admin/admin-sidebar.php';
			}
		}

		echo "\n <aside id='sidebar' data-xhr='sidebar'>";
		if($myPage)
		{
			require_once $myPage;
			echo "\n";
		}
		echo "</aside>";
	}


	// public static function nav()
	// {
	// 	$myPage = null;
	// 	// do nothing

	// 	if($myPage !== null)
	// 	{
	// 		echo "\n <nav id='pageNav' data-xhr='pageNav'>";
	// 		if($myPage)
	// 		{
	// 			require_once $myPage;
	// 		}
	// 		echo "\n </nav>";
	// 	}
	// }

	public static function pageScript()
	{
  		echo "\n  ";
		echo "<div data-xhr='pageScript'>";
		echo "<script async";
		if(\dash\data::loadScript() && is_string(\dash\data::loadScript()))
		{
			echo ' src="'. \dash\url::cdn(). \dash\data::loadScript(). '"';
		}
  		echo "></script>";
  		echo "</div>";
	}
}
?>
