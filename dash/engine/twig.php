<?php
namespace dash\engine;

class twig
{
	public static function init()
	{
		\dash\data::loadMode('normal');

		if(\dash\request::ajax())
		{
			// set file name of static parts
			\dash\data::display_dash("includes/html/display-dash-xhr.html");
			\dash\data::display_enter("includes/html/display-enter-xhr.html");
			\dash\data::display_pwa("includes/html/pwa/pwa-xhr.html");
			// generate main filename automatically because used on various condition
			$file_xhr_main = substr(\dash\data::display_main(), 0, -5). '-xhr.html';
			\dash\data::display_main($file_xhr_main);
		}

		$module = str_replace('/', '\\', \dash\engine\mvc::get_dir_address());
		$tmpname = $module.'\\display.html';
		// on pwa try to read pwa.html
		if(\dash\detect\device::detectPWA())
		{
			$tmpname = $module.'\\pwa.html';
			// show error if display is not exist
			$tmpname_addr = \autoload::fix_os_path(root. ltrim($tmpname, '\\'));
			if(!is_file($tmpname_addr))
			{
				$tmpname = $module.'\\display.html';
				// try to use pwa template file if exist instead of original file
				\dash\data::display_dash(\dash\data::display_pwa());
			}
		}
		// show error if display is not exist
		$tmpname_addr = \autoload::fix_os_path(root. ltrim($tmpname, '\\'));
		if(!is_file($tmpname_addr))
		{
			if(\dash\url::content() === null && \dash\egnine\template::$finded_template)
			{
				$tmpname_addr = root. \dash\egnine\template::$display_name;
				$tmpname_addr = \autoload::fix_os_path($tmpname_addr);
				if(!is_file($tmpname_addr))
				{
					\dash\header::status(206, "without display");
					return false;
				}
				$tmpname = \dash\egnine\template::$display_name;
			}
			else
			{
				\dash\header::status(206, "without display");
				return false;
			}

		}

		\dash\data::pagination(\dash\utility\pagination::page_number());
		\dash\data::paginationDetail(\dash\utility\pagination::detail());

		// twig method
		require_once core.'bin/Twig/autoload.php';


		$twig_include_path     = [];
		$twig_include_path[]   = root;
		$loader                = new \Twig\Loader\FilesystemLoader($twig_include_path);
		$array_option          = [];
		$array_option['debug'] = true;
		if(!\dash\url::isLocal())
		{
			$array_option['cache'] = root.'/tmp/twig';
		}

		$twig = new \Twig\Environment($loader, $array_option);

		\dash\engine\twigFn::init($twig);

		$twig->addGlobal("session", $_SESSION);

		if(\dash\engine\error::debug_mode())
		{
			$twig->addExtension(new \Twig_Extension_Debug());
		}

		$twig->addExtension(new \Twig_Extensions_Extension_I18n());


		$template = $twig->loadTemplate($tmpname);
		if(\dash\request::ajax())
		{
			\dash\data::global_debug(\dash\notif::get());
			$xhr_render = $template->render(\dash\data::get());

			echo json_encode(\dash\data::get('global'));
			echo "\n";
			echo $xhr_render;
		}
		else
		{
			$template->display(\dash\data::get());
			// echo $twig->render($tmpname, \dash\data::get());
		}


	}
}
?>