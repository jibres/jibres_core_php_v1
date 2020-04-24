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


	public static function allNotifs()
	{
		$myNotif = \dash\notif::jsonHtml();
		if($myNotif)
		{
			echo "\n  <div id='pageNotif' style='display:none;'>". $myNotif. "</div>";
		}
	}

	public static function main()
	{
		$myMain = \dash\layout\func::page_main();

		// set header for some scenario
		// if we dont have header
		// and we are not in api content
		if($myMain === null && !\dash\engine\content::api_content())
		{
			if(\dash\data::include_adminPanel())
			{
				// admin panels
				$myMain = core.'layout/admin/admin-main.php';
			}
			elseif(\dash\engine\content::get() === 'content')
			{
				// jibres homepage webiste
				$myMain = root.'content/home/layout/main.php';
			}
			elseif(\dash\engine\content::get() === 'content_enter')
			{
				$myMain = root.'content_enter/home/layout/main.php';
				// do nothing
			}
		}


		if($myMain !== null || \dash\layout\func::display())
		{
			echo "\n <main id='pageContent' data-xhr='pageContent'";
			if (\dash\detect\device::detectPWA())
			{
				echo " data-scroll";
			}
			echo ">";
			if($myMain)
			{
				require_once $myMain;
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
			$headerScroll = null;
			if (\dash\detect\device::detectPWA())
			{
				// if is not set, on pwa force add
				$myHeader = core.'layout/pwa/pwa-header.php';
				$headerScroll = true;
			}
			else
			{
				$myContent = \dash\engine\content::get();
				if(\dash\data::include_adminPanel())
				{
					// admin panels
					$myHeader = core.'layout/admin/admin-header.php';
				}
				elseif($myContent === 'content')
				{
					// jibres homepage webiste
					$myHeader = root.'content/home/layout/header.php';
				}
				elseif($myContent === 'content_subdomain')
				{
					// subdomain of stores
					$myHeader = root.'content_subdomain/home/layout/header.php';
				}
				elseif($myContent === 'content_developers')
				{
					// subdomain of stores
					$myHeader = root.'content_developers/home/layout/header.php';
				}
			}
		}

		echo "\n <header id='pageHeader' data-xhr='pageHeader'";
		if($headerScroll)
		{
			echo " data-scroll";
		}
		echo ">";
		if($myHeader)
		{
			require_once $myHeader;
			echo "\n  ";
		}
		echo "</header>";
	}


	public static function footer()
	{
		$myFooter = \dash\layout\func::page_footer();

		// set header for some scenario
		// if we dont have header
		// and we are not in api content
		if($myFooter === null && !\dash\engine\content::api_content())
		{
			if (\dash\detect\device::detectPWA())
			{
				// if is not set, on pwa force add
				$myFooter = core.'layout/pwa/pwa-footer.php';
			}
			else
			{
				if(\dash\engine\content::get() === 'content')
				{
					// jibres homepage webiste
					$myFooter = root.'content/home/layout/footer.php';
				}
			}
		}

		echo "\n <footer id='pageFooter' data-xhr='pageFooter'>";
		if($myFooter)
		{
			require_once $myFooter;
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
		if(\dash\data::loadScript() && is_string(\dash\data::loadScript()))
		{
			echo "<script async";
			echo ' src="'. \dash\url::cdn(). \dash\data::loadScript(). '"';
  			echo "></script>";
		}
  		echo "</div>";
	}
}
?>
