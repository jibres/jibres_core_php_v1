<?php
namespace dash\layout;
/**
 * dash main configure
 */
class find
{

	public static function allBlocks()
	{
		if(\dash\request::get('xhr'))
		{
			switch (\dash\request::get('xhr'))
			{
					case 'sidebar':
						self::sidebar();
						break;

					case 'header':
						self::header();
						break;

					case 'main':
						self::main();
						break;

					case 'footer':
						self::footer();
						break;

					default:
						break;
				}
		}
		else
		{
			self::sidebar();
			self::header();
			// self::nav();
			self::main();
			self::footer();
		}
	}


	public static function loadMore($_xhrName = null)
	{
		$moreAddr = \dash\layout\func::more_addr();

		if (is_file($moreAddr))
		{
			echo "\n <div class='loadMore' data-xhr='loadMore'>";
			require_once $moreAddr;
			echo "\n </div>";
		}
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
		if($myMain === null && !\dash\url::is_api())
		{
			if(\dash\data::include_adminPanel())
			{
				// admin panels
				$myMain = core.'layout/admin/admin-main.php';
			}
			elseif(\dash\data::include_adminPanelBuilder())
			{
				// admin panels
				$myMain = core.'layout/panelBuilder/panelBuilder-main.php';
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

		if(\dash\layout\business::website())
		{
			$temp_myMain = \dash\layout\business::body_addr();
			if($temp_myMain)
			{
				$myMain = $temp_myMain;
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
		$headerScroll = null;

		// set header for some scenario
		// if we dont have header
		// and we are not in api content
		if($myHeader === null && !\dash\url::is_api())
		{
			$headerScroll = true;
			$myContent = \dash\engine\content::get();

			if(\dash\data::include_adminPanel())
			{
				// admin panels
				$myHeader = core.'layout/admin/admin-header.php';
			}
			elseif(\dash\data::include_adminPanelBuilder())
			{
				// siteBuilder panels
				$myHeader = core.'layout/panelBuilder/panelBuilder-header.php';
			}
			elseif($myContent === 'content')
			{
				// jibres homepage webiste
				$myHeader = root.'content/home/layout/header.php';
			}
			elseif($myContent === 'content_business')
			{
				if(\dash\layout\business::have_header())
				{
					if(\dash\layout\business::$new_sitebuilder)
					{
						$myHeader = root. 'content_site/load/header.php';
					}
					else
					{
						$myHeader = root. 'lib/pagebuilder/load/header.php';
					}
				}
				else
				{
					// subdomain of stores
					$myHeader = root.'content_business/home/layout/header.php';
				}
			}
			elseif($myContent === 'content_developers')
			{
				// subdomain of stores
				$myHeader = root.'content_developers/home/layout/header.php';
			}
		}

		echo "\n <header id='pageHeader' data-xhr='pageHeader'";
		if($headerScroll)
		{
			echo " data-scroll";
		}
		echo ">";

		// add desktop header
		if($myHeader)
		{
			echo "<div class='desktop'>";
			require_once $myHeader;
			echo "</div>";
		}

		// add pwa header
		{
			require_once core.'layout/pwa/pwa-header.php';
		}

		echo "</header>";
	}


	public static function footer()
	{
		$myFooter = \dash\layout\func::page_footer();
		$myContent = \dash\engine\content::get();

		// set footer for some scenario
		// if we dont have footer
		// and we are not in api content
		if($myFooter === null && !\dash\url::is_api())
		{
			if(\dash\engine\content::get() === 'content')
			{
				// jibres homepage webiste
				$myFooter = root.'content/home/layout/footer.php';
			}
			elseif($myContent === 'content_business')
			{
				if(\dash\layout\business::have_footer())
				{
					if(\dash\layout\business::$new_sitebuilder)
					{
						$myFooter = root. 'content_site/load/footer.php';
					}
					else
					{
						$myFooter = root. 'lib/pagebuilder/load/footer.php';
					}
				}
				else
				{
					// subdomain of stores
					$myFooter = root.'content_business/home/layout/footer.php';
				}
			}
			elseif(\dash\data::include_adminPanelBuilder())
			{
				$myFooter = core.'layout/panelBuilder/panelBuilder-footer.php';
			}
		}


		echo "\n <footer id='pageFooter' data-xhr='pageFooter'>";
		if($myFooter)
		{
			echo "<div class='desktop'>";
			require_once $myFooter;
			echo "</div>";
		}

		// add pwa footer
		{
			require_once core.'layout/pwa/pwa-footer.php';
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
		elseif(\dash\data::include_adminPanelBuilder())
		{
			// siteBuilder panels
			require_once core.'layout/panelBuilder/panelBuilder-sidebar.php';
		}
		echo "</aside>";
	}


	public static function pageScript()
	{
		// page script
		if(\dash\data::global_scriptPage())
		{
			echo "<div data-pagescript='". \dash\data::global_scriptPage(). "'></div>";
		}
	}
}
?>
