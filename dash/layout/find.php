<?php
namespace dash\layout;
/**
 * dash main configure
 */
class find
{

	public static function allBlocks()
	{
		if(\dash\header::get('x-xhr'))
		{
			switch (\dash\header::get('x-xhr'))
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
			self::header();
			echo '<div id="pageCenter" data-xhr="pageCenter">';
			self::sidebar();
			self::main();
			echo '</div>';
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
			elseif(\dash\data::include_m2())
			{
				// admin panels
				$myMain = core.'layout/m2/panelBuilder_main.php';
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
		$myHeader      = \dash\layout\func::page_header();
		$myHeaderNewClass = null;
		$headerScroll  = null;

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
			elseif(\dash\data::include_m2())
			{
				if(\dash\data::include_m2() === 'siteBuilder')
				{
					$myHeader = core.'layout/m2/header_siteBuilder.php';
				}
				else
				{
					// siteBuilder panels
					$myHeaderNewClass = \dash\layout\m2\header::html();
				}
			}
			elseif($myContent === 'content')
			{
				// jibres homepage webiste
				$myHeader = root.'content/home/layout/header.php';
			}
			elseif($myContent === 'content_business')
			{
				$myHeader = root. 'content_site/load/header.php';
				// if(\dash\layout\business::have_header())
				// {
				// 	if(\dash\layout\business::$new_sitebuilder)
				// 	{
				// 		$myHeader = root. 'content_site/load/header.php';
				// 	}
				// 	else
				// 	{
				// 		$myHeader = root. 'lib/pagebuilder/load/header.php';
				// 	}
				// }
				// else
				// {
				// 	// subdomain of stores
				// 	$myHeader = root.'content_business/home/layout/header.php';
				// }
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
		if($myHeaderNewClass)
		{
			echo "<div class='desktop'>";
			echo $myHeaderNewClass;
			echo "</div>";
		}
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
				$myFooter = root. 'content_site/load/footer.php';
				// if(\dash\layout\business::have_footer())
				// {
				// 	if(\dash\layout\business::$new_sitebuilder)
				// 	{
				// 	}
				// 	else
				// 	{
				// 		$myFooter = root. 'lib/pagebuilder/load/footer.php';
				// 	}
				// }
				// else
				// {
				// 	// subdomain of stores
				// 	$myFooter = root.'content_business/home/layout/footer.php';
				// }
			}
			elseif(\dash\data::include_m2())
			{
				\dash\data::include_adminPanelFooter(true);
				$myFooter = core.'layout/m2/panelBuilder_footer.php';
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
		$footerPWA = \dash\layout\pwa\footer2::html();
		echo $footerPWA;

		self::jibres_brand();

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
		elseif(\dash\data::include_m2())
		{
			// change condition to turn on with flag or use address to enable old sidebar for sitebuilder
			if(\dash\data::include_m2() === 'siteBuilder')
			{
				// siteBuilder panels
				require_once core.'layout/m2/panelBuilder_sidebar.php';
			}
			else
			{
				echo \dash\layout\m2\sidebar::html();
			}
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


	private static function jibres_brand()
	{
		return;

		if(!\dash\url::isLocal())
		{
			return;
		}

		if(!\dash\engine\store::inStore())
		{
			return;
		}

		// check plan has remove brand
		if(false)
		{
			return;
		}

		$link   = 'https://jibres.'. \dash\url::jibres_tld();
		$msg    = T_("Powered by Jibres");
		$target = 'target="_blank"';

		if(in_array(\dash\url::content(), ['a', 'crm', 'cms', 'site']))
		{
			$link   = \dash\url::kingdom(). '/a/plugin/view/remove_brand';
			$msg    = T_("Powered by Jibres");
			$msg    .= ' '. T_("You can remove jibres brand");
			$target = '';
		}

		$html = '';
		$html .= '<a href="'.$link.'" '. $target .'>';
		{
			$html .= '<div class="alert-danger justify-center text-center">';
			{
				$html .= $msg;
			}
			$html .= '</div>';
		}
		$html .= '</a>';

		echo $html;

	}

}
?>
