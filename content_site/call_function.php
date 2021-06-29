<?php
namespace content_site;


class call_function
{

	private static function get_namespace($_section_key)
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
			$folder = 'ganje';
		}

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
	private static function _call($_fn, $_args = [])
	{
		if(is_callable($_fn))
		{
			return call_user_func($_fn, $_args);
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

				$full_option_list = self::_call([$namespace, 'option'], 'full');

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
			else
			{
				$namespace = sprintf($namespace, 'option');

				return self::_call([$namespace, $_fn], $args);
			}
		}

	}

}
?>