<?php
namespace content_site;


class call_function
{

	private static function get_namespace($_folder, $_section_key)
	{
		switch ($_folder)
		{
			case 'header':
				$_folder = 'h';
				break;

			case 'footer':
				$_folder = 'f';
				break;

			case 'body':
			default:
				$_folder = 'ganje';
				break;
		}

		return '\\content_site\\'. $_folder .'\\'. $_section_key. '\\%s';
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
			$folder      = a($_args, 0);
			$section_key = a($_args, 1);

			unset($_args[0]);
			unset($_args[1]);

			$namespace = self::get_namespace($folder, $section_key);

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

				return self::_call([$namespace, 'layout'], ...$_args);
			}
			else
			{
				$namespace = sprintf($namespace, 'option');

				return self::_call([$namespace, $_fn], ...$_args);
			}
		}

	}

}
?>