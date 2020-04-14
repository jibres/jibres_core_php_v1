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
		$myHeader = \dash\layout\func::page_header();

		// set header for some scenario
		// if we dont have header
		// and we are not in api content
		if($myHeader === null && !\dash\engine\content::api_content())
		{
			if (\dash\detect\device::detectPWA())
			{
				// if is not set, on pwa force add
				$myHeader = core.'layout/pwa/pwa-header.php';
			}
			else
			{
				if(\dash\engine\content::get() === 'content')
				{
					// jibres homepage webiste
					$myHeader = root.'content/home/layout/header.php';
				}
				elseif(\dash\data::include_adminPanel())
				{
					// admin panels
					$myHeader = core.'layout/admin/admin-header.php';
				}
				elseif(\dash\engine\content::get() === 'content_subdomain')
				{
					// subdomain of stores
					$myHeader = root.'content_subdomain/home/layout/header.php';
				}
			}
		}

		echo "\n  <header id='pageHeader' data-xhr='pageHeader' data-scroll>";
		if($myHeader)
		{
			require_once $myHeader;
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
		echo "\n <aside id='sidebar' data-xhr='sidebar'>";
		if(\dash\data::include_adminPanel())
		{
			require_once core.'layout/admin/admin-sidebar.php';
			echo "\n";
		}
		echo "</aside>";
	}


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
