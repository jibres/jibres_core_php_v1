<?php
namespace content_site;


class call_function
{
	public static function get_folder($_section_key)
	{
		if(substr($_section_key, 0, 1) === 'h' && is_numeric(substr($_section_key, 1, 1)))
		{
			$folder = 'header';
		}
		elseif(substr($_section_key, 0, 1) === 'f' && is_numeric(substr($_section_key, 1, 1)))
		{
			$folder = 'footer';
		}
		else
		{
			$folder = 'body';
		}

		return $folder;
	}



	private static function get_namespace($_section_key)
	{
		$folder = self::get_folder($_section_key);

		return '\\content_site\\'. $folder .'\\'. $_section_key. '\\%s';
	}




	/**
	 * Get option namespace
	 *
	 * @param      string  $_section_key  The child
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	private static function option_namespace($_option = null)
	{
		$namespace = '\\content_site\\options\\';
		if(strpos($_option, '_') !== false)
		{
			$namespace .= strtok($_option, '_'). '\\';
		}

		$namespace .= $_option;

		return $namespace;
	}



	/**
	 * Call function
	 *
	 * @param      <type>  $_fn    The function
	 * @param      array   $_args  The arguments
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function _call($_fn, $_args = [], $_args2 = [])
	{
		if(is_callable($_fn))
		{
			if($_args2)
			{
				return call_user_func_array($_fn, [$_args, $_args2]);
			}
			else
			{
				return call_user_func($_fn, $_args);
			}
		}
		else
		{
			if(\dash\url::isLocal())
			{
				// var_dump(func_get_args());exit;
			}
			return null;
		}

	}


	/**
	 * Call every function you need
	 *
	 * @param      <type>  $_fn    The function
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function __callStatic($_fn, $_args)
	{
		// call option_admin_html
		// call option_validator
		if(substr($_fn, 0, 7) === 'option_')
		{
			$function = substr($_fn, 7);

			$option = null;

			if(isset($_args[0]))
			{
				$option = $_args[0];
			}

			unset($_args[0]);

  			return self::_call([self::option_namespace($option), $function], ...$_args);
		}
		else
		{
			$section_key = a($_args, 0);
			$args        = a($_args, 1);

			$namespace = self::get_namespace($section_key);

			if($_fn === 'default')
			{
				$namespace = sprintf($namespace, 'option');

				$full_option_list = self::_call([$namespace, 'option'], $args, 'full');

				if(isset($full_option_list['default']) && is_array($full_option_list['default']))
				{
					return $full_option_list['default'];
				}
				else
				{
					return [];
				}
			}
			elseif($_fn === 'layout')
			{
				$namespace = sprintf($namespace, 'layout');

				return self::_call([$namespace, 'layout'], $args);
			}
			elseif($_fn === 'preview')
			{
				$namespace = sprintf($namespace, 'preview');

				return self::_call([$namespace, $args]);
			}
			elseif($_fn === 'preview_list')
			{
				$namespace_preview = sprintf($namespace, 'preview');

				$function_list = [];

				if(class_exists($namespace_preview))
				{
					$function_list = get_class_methods($namespace_preview);
				}

				$list = [];

				foreach ($function_list as $key => $value)
				{
					$load_preview = self::_call([$namespace_preview, $value]);

					$myType = a($load_preview, 'type');

					$list[] =
					[
						'preview_key' => $value,
						'opt_type'    => $myType,
						'iframe_url'  => \dash\url::here(). '/preview/'. $section_key. '/'. $value,
					];

				}

				return $list;
			}
			else
			{
				$namespace = sprintf($namespace, 'option');

				return self::_call([$namespace, $_fn], $args);
			}
		}

	}



	public static function generate_preview($_section, $_preview)
	{
		$namespace = self::get_namespace($_section);

		$default = \content_site\call_function::default($_section);

		if(!is_array($default))
		{
			$default = [];
		}

		$options = \content_site\call_function::option($_section);

		$default_options = [];

		foreach ($options as $option_name)
		{
			if(is_string($option_name))
			{
				$default_options[$option_name] = self::option_default($option_name);
			}
		}

		$namespace_preview = sprintf($namespace, 'preview');

		if(!is_callable([$namespace_preview, $_preview]))
		{
			return false;
		}

		$namespace_layout  = sprintf($namespace, 'layout');


		\content_site\utility::fill_by_default_data(true);

		$preview_default = self::_call([$namespace_preview, $_preview]);

		$preview_default = array_merge($default_options, $default, $preview_default);

		$preview_default = self::replace_paw_value($preview_default);

		$preview_html    = self::_call([$namespace_layout, 'layout'], $preview_default);

		$result =
		[
			'preview_key'     => $_preview,
			'preview_default' => $preview_default,
			'preview_html'    => $preview_html,
		];


		\content_site\utility::fill_by_default_data(false);

		return $result;

	}


	private static function replace_paw_value($_data)
	{
		$new_data = $_data;

		$is_pwa = \dash\request::is_pwa();

		foreach ($_data as $key => $value)
		{
			if(substr($key, 0, 12) === 'preview_pwa:' && $is_pwa)
			{
				$new_data[substr($key, 12)] = $value;
			}

			if(substr($key, 0, 8) === 'preview:')
			{
				$new_data[substr($key, 8)] = $value;
			}
		}

		return $new_data;
	}


}
?>