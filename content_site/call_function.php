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
			$args2       = a($_args, 2);

			$namespace = self::get_namespace($section_key);


			if($_fn === 'layout')
			{
				$namespace = sprintf($namespace, 'layout');

				return self::_call([$namespace, 'layout'], $args);
			}
			elseif($_fn === 'preview')
			{
				$namespace = sprintf($namespace, $args);

				$load_preview = self::_call([$namespace, $args2]);

				return $load_preview;
			}
			else
			{
				$namespace = sprintf($namespace, 'option');

				return self::_call([$namespace, $_fn], $args);
			}
		}

	}

	/**
	 * Get current option by check type
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function default($_section_key, $_type)
	{
		$namespace   = self::get_namespace($_section_key);

		$namespace   = sprintf($namespace, $_type);

		$type_detail = self::_call([$namespace, 'option']);

		if(isset($type_detail['default']))
		{
			return $type_detail['default'];
		}

		return null;
	}


	/**
	 * Get current option by check type
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function option($_section_key, $_type)
	{
		$namespace   = self::get_namespace($_section_key);

		$namespace   = sprintf($namespace, $_type);

		$type_detail = self::_call([$namespace, 'option']);

		if(isset($type_detail['options']))
		{
			return $type_detail['options'];

			// $options = [];
			// foreach ($type_detail['options'] as $key => $value)
			// {
			// 	if(is_array($value))
			// 	{
			// 		$options = array_merge($options, $value);
			// 	}
			// 	else
			// 	{
			// 		$options[] = $value;
			// 	}
			// }

			// return $options;
		}

		return null;
	}


	public static function ready_type_list($_section_key)
	{
		$namespace = self::get_namespace($_section_key);

		$type_list = self::type_list($_section_key);

		if(!is_array($type_list))
		{
			$type_list = [];
		}

		$list = [];

		foreach ($type_list as $value)
		{
			$namespace_type = sprintf($namespace, $value);

			$temp_load_type_option = self::_call([$namespace_type, 'option']);
			$list[]                = $temp_load_type_option;

		}

		return $list;

	}

	public static function preview_list($_section_key, $_filter_category = null)
	{
		$namespace = self::get_namespace($_section_key);

		$filter_category = [];

		$popular = [];

		if(!$_filter_category || $_filter_category === 'popular')
		{
			$popular = self::popular($_section_key);

			if(!is_array($popular))
			{
				$popular = [];
			}
		}

		if($popular)
		{
			$filter_category = $popular;
		}
		else
		{
			$type_list = self::type_list($_section_key);

			if(!is_array($type_list))
			{
				$type_list = [];
			}

			foreach ($type_list as $value)
			{

				if($value !== $_filter_category && $_filter_category !== 'all')
				{
					continue;
				}

				$namespace_type = sprintf($namespace, $value);

				$temp_load_type_option = self::_call([$namespace_type, 'option']);

				if(isset($temp_load_type_option['preview_list']) && is_array($temp_load_type_option['preview_list']))
				{
					foreach ($temp_load_type_option['preview_list'] as $temp_preview_list)
					{
						$filter_category[] = "$value:$temp_preview_list";
					}
				}
			}
		}

		$list = [];

		foreach ($filter_category as $key => $preview_key)
		{
			$type    = null;
			$preview = null;
			if(strpos($preview_key, ':') !== false)
			{
				$split   = explode(':', $preview_key);

				$type    = $split[0];
				$preview = $split[1];
			}
			else
			{
				$type    = $preview_key;
				$preview = null;
			}

			$namespace_type = sprintf($namespace, $type);

			$load_type_option = self::_call([$namespace_type, 'option']);

			$need_load_preview = [];

			if($preview)
			{
				$need_load_preview[] = $preview;
			}
			else
			{
				$load_type_option = self::_call([$namespace_type, 'option']);

				if(isset($load_type_option['preview_list']) && is_array($load_type_option['preview_list']))
				{
					$need_load_preview = $load_type_option['preview_list'];
				}
			}

			foreach ($need_load_preview as $preview_function)
			{
				$load_preview = self::_call([$namespace_type, $preview_function]);

				$version = (a($load_preview, 'version') ? $load_preview['version'] : 1);

				$list[] =
				[
					'key'           => $_section_key,
					'type_title'    => a($load_type_option, 'title'),
					'preview_title' => a($load_preview, 'preview_title'),
					'preview_image' => a($load_preview, 'preview_image'),
					'preview_key'   => $preview_function,
					'version'       => $version,
					'opt_type'      => $type,
					'demo_url'    => 'https://demo.jibres.store/preview/'. $_section_key. '/'. $type. '/'. $preview_function,
					'preview_image' => \dash\url::cdn(). sprintf('/img/sitebuilder/%s/%s/%s.jpg?v=%s', $_section_key, $type, $type. '-'. $preview_function, $version),
				];
			}
		}

		return $list;
	}



	public static function generate_preview($_section, $_type, $_preview)
	{
		$namespace = self::get_namespace($_section);

		$default = self::default($_section, $_type);

		if(!is_array($default))
		{
			$default = [];
		}

		$namespace_preview = sprintf($namespace, $_type);

		if(!is_callable([$namespace_preview, $_preview]))
		{
			return false;
		}

		$namespace_layout  = sprintf($namespace, 'layout');


		\content_site\utility::fill_by_default_data(true);

		$preview_default = self::_call([$namespace_preview, $_preview]);

		$preview_default = array_merge($default, a($preview_default, 'options'));

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
		$is_pwa = \dash\request::is_pwa();

		foreach ($_data as $key => $value)
		{
			if(substr($key, 0, 4) === 'pwa:' && $is_pwa)
			{
				$_data[substr($key, 4)] = $value;
			}
		}

		return $_data;
	}


}
?>