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
		return '\\content_site\\options\\'.$_option;
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
				var_dump(func_get_args());exit;
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
			elseif($_fn === 'preview_list')
			{
				$default = \content_site\call_function::default($section_key);

				if(!is_array($default))
				{
					$default = [];
				}

				$namespace_preview = sprintf($namespace, 'preview');

				$namespace_layout  = sprintf($namespace, 'layout');

				$function_list = [];

				if(class_exists($namespace_preview))
				{
					$function_list = get_class_methods($namespace_preview);
				}

				$list = [];

				foreach ($function_list as $key => $value)
				{
					$preview_default = self::_call([$namespace_preview, $value]);

					$preview_default = array_merge($default, $preview_default);

					$preview_html    = self::_call([$namespace_layout, 'layout'], $preview_default);

					$list[] =
					[
						'preview_key'     => $value,
						'preview_default' => $preview_default,
						'preview_html'    => $preview_html,
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

}
?>