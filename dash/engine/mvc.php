<?php
namespace dash\engine;


class mvc
{
	private static $folder_addr  = null;
	private static $routed_addr  = null;
	private static $only_folder  = null;


	/**
	 * start main to detect controller and from 0 km to ...
	 * @return [type] [description]
	 */
	public static function fire()
	{
		// get best controller
		$finded_controller  = self::find_ctrl();
		if($finded_controller)
		{
			self::load_controller();

			self::load_view();

			self::load_model();
		}
	}


	/**
	 * find best controller for this url
	 * @return [type] [description]
	 */
	private static function find_ctrl()
	{
		$my_repo       = '\\'. \dash\engine\content::get();
		$my_module     = '\\'. \dash\url::module();
		$my_child      = '\\'. \dash\url::child();
		$my_subchild   = '\\'. \dash\url::subchild();
		$my_controller = null;

		$addr_content = \dash\url::content();
		$addr_module  = '/'. \dash\url::module();


		if(\dash\url::subchild() !== null)
		{
			// something like \content_sudo\tools\test\abc\controller.php
			$my_controller = self::checking($my_repo. $my_module. $my_child. $my_subchild);
			if($my_controller)
			{
				self::$routed_addr = $addr_content. $addr_module. '/'. \dash\url::child(). '/'. \dash\url::subchild();
				return $my_controller;
			}
		}

		if(\dash\url::child() !== null)
		{
			if(\dash\url::child() === 'home' || \dash\url::child() === 'layout')
			{
				\dash\header::status('404');
			}
			// something like \content_sudo\tools\test\controller.php
			$my_controller = self::checking($my_repo. $my_module. $my_child);
			if($my_controller)
			{
				self::$routed_addr = $addr_content. $addr_module. '/'. \dash\url::child();
				return $my_controller;
			}
		}

		if(\dash\url::module() !== null)
		{
			if(\dash\url::module() === 'home')
			{
				\dash\header::status('404');
			}
			// something like \content_sudo\tools\home\controller.php
			$my_controller = self::checking($my_repo. $my_module. '\home');
			if($my_controller)
			{
				self::$routed_addr = $addr_content. $addr_module;
				return $my_controller;
			}

			// something like \content_sudo\tools\controller.php
			$my_controller = self::checking($my_repo. $my_module);
			if($my_controller)
			{
				self::$routed_addr = $addr_content. $addr_module;
				return $my_controller;
			}
		}

		if(\dash\engine\content::get())
		{
			// something like \content_sudo\home\controller.php
			$my_controller = self::checking($my_repo. '\home');
			if($my_controller)
			{
				self::$routed_addr = $addr_content;
				return $my_controller;
			}
		}

		// something like \content\home\controller.php
		$my_controller = self::checking('\content\home');
		if($my_controller)
		{
			self::$routed_addr = '/';
			return $my_controller;
		}

		$template = self::find_tmplate();
		if($template)
		{
			self::$routed_addr = \dash\url::pwd();
			return $template;
		}

		// nothing found, show error page
		\dash\header::status(501, T_("Hey, Read documentation and start your project!"));
	}



	private static function find_tmplate()
	{
		if(\dash\url::content())
		{
			return false;
		}

		$template = \dash\engine\template::find();

		if(\dash\engine\template::$finded_template)
		{
			self::$folder_addr = \dash\engine\template::$display_name;
			return true;
		}
	}


	/**
	 * check controller in project
	 * @param  [type] $_addr [description]
	 * @return [type]        [description]
	 */
	private static function checking($_addr)
	{
		$find   = null;
		$myctrl = $_addr. '\\controller';

		if(class_exists($myctrl))
		{
			$find = $myctrl;
		}
		else
		{
			$_addr = trim($_addr, '\\');
			$temp_addr = \autoload::fix_os_path($_addr);
			if(is_dir(root. $temp_addr))
			{
				self::$only_folder = true;
				$find              = true;
			}
		}
		if($find)
		{
			// set module addr to use in all other function for addressing
			self::$folder_addr = $_addr;
		}

		return $find;
	}



	/**
	 * load specefic controller
	 * @param  [type] $controller [description]
	 * @return [type]              [description]
	 */
	private static function load_controller()
	{
		$my_controller = self::$folder_addr. '\\controller';
		if(!class_exists($my_controller) && !self::$only_folder)
		{
			\dash\header::status(409, $my_controller);
		}

		// run content default function for set something if needed
		$content_controller = \dash\engine\content::get().'\\controller';
		if(is_callable([$content_controller, 'routing']))
		{
			$content_controller::routing();
		}

		if(is_callable([$my_controller, 'routing']))
		{
			$my_controller::routing();
		}

		// generate real address of current page
		$real_address = trim(\dash\url::content(). '/'. \dash\url::directory(), '/');

		if($real_address === '')
		{
			$real_address = null;
		}


		// if we are in another address of current routed in controller, double check
		if(trim((string) self::$routed_addr, '/') != $real_address)
		{
			// if this url has no custom licence, block it
			if(!\dash\open::license())
			{
				$template = self::find_tmplate();
				if($template)
				{
					self::$routed_addr = \dash\url::pwd();
					return $template;
				}
				else
				{
					if(!\dash\url::child() && \dash\url::module() && \dash\engine\store::inBusinessDomain())
					{
						\lib\app\staticfile\get::business_static_file();
					}

					\dash\header::status(404, T_("We can't find the page you're looking for!"));
				}
			}
		}

		// call routed function after check 404 page
		if(is_callable([$content_controller, 'routed']))
		{
			$content_controller::routed();
		}

		if(is_callable([$my_controller, 'routed']))
		{
			$my_controller::routed();
		}

		// check user not send html if not alowed
		\dash\allow::check_allow_html();

		// check user not send any file
		\dash\allow::check_allow_file();


	}


	private static function load_view()
	{
		$my_view = self::$folder_addr. '\\view';
		if(\dash\request::is('get') && !\dash\request::json_accept())
		{
			\dash\engine\view::variable();

			// run content default function for set something if needed
			$content_view = \dash\engine\content::get().'\\view';
			if(is_callable([$content_view, 'config']))
			{
				$content_view::config();
			}

			// run default function of view
			if(is_callable([$my_view, 'config']))
			{
				$my_view::config();
			}

			// call custom function if exist
			$my_view_function = \dash\open::license(null, true);
			if($my_view_function && is_callable([$my_view, $my_view_function]))
			{
				$my_view::$my_view_function();
			}

			// combine two type of set title into one
			if(\dash\url::content() === null || \dash\url::content() === 'n')
			{
				// maybe dataRow is full
				if(!\dash\data::dataRow())
				{
					\dash\data::dataRow(\dash\engine\template::$dataRow);
				}
				\dash\engine\view::set_cms_titles();
			}
			else
			{
				\dash\engine\view::set_title();
			}

			\dash\engine\view::lastChanges();

			// add header before echo anything
			\dash\waf\race::requestDone();
			\dash\engine\runtime::shutdown();

			$nativeTemplate = \dash\layout\func::shoot();

			if(!$nativeTemplate)
			{
				if(\dash\url::is_api())
				{
					// in api contenct not allow this method
					\dash\header::status(405);
				}
				else
				{
					\dash\header::status(206, "Without display");
				}
				return false;
			}
		}
	}


	/**
	 * try to load model if needed and empty page post parameter
	 * @return [type] [description]
	 */
	private static function load_model()
	{
		if(\dash\request::is('options'))
		{
			// request option and send okay
			\dash\header::status(200);
		}
		elseif(\dash\request::is('head'))
		{
			// request option and send okay
			\dash\header::status(204);
		}
		elseif(!\dash\request::is('get'))
		{
			$my_model = self::$folder_addr. '\\model';
			if(class_exists($my_model))
			{
				$my_model_function = \dash\open::license(null, true);
				if($my_model_function && is_callable([$my_model, $my_model_function]))
				{
					$my_model::$my_model_function();
				}
				else
				{
					// show not implemented message
					\dash\header::status(405);
				}
			}
			else
			{
				// model does not exist in this folder, show not acceptable message
				\dash\header::status(405);
			}

			// add header febore echo anything
			\dash\waf\race::requestDone();
			\dash\engine\runtime::shutdown();

			\dash\code::compile();
		}
	}

	/**
	 * show address of current module dir
	 * @return [type] [description]
	 */
	public static function get_dir_address()
	{
		return self::$folder_addr;
	}
}
?>