<?php
namespace content_site;


class call_function
{

	/**
	 * Get ganje namespace
	 *
	 * @param      string  $_child  The child
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	private static function ganje_namespace($_child = null)
	{
		if(!$_child)
		{
			$_child = \dash\url::child();
		}

		return '\\content_site\\ganje\\'. $_child. '\\%s';
	}



	/**
	 * Get ganje namespace
	 *
	 * @param      string  $_child  The child
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	private static function header_namespace($_child = null)
	{
		if(!$_child)
		{
			$_child = \dash\url::child();
		}

		return '\\content_site\\h\\'. $_child. '\\%s';
	}




	/**
	 * Get option namespace
	 *
	 * @param      string  $_child  The child
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
			// call detail($_section)
			if(isset($_args[0]) && is_string($_args[0]))
			{
				if(\dash\url::module() === 'header')
				{
		  			$namespace = self::header_namespace($_args[0]);
				}
				else
				{
					$namespace = self::ganje_namespace($_args[0]);
				}
			}
			else
			{
				if(\dash\url::module() === 'header')
				{
		  			$namespace = self::header_namespace();
				}
				else
				{
					$namespace = self::ganje_namespace();
				}
			}

			$namespace = sprintf($namespace, 'option');

			return self::_call([$namespace, $_fn], ...$_args);
		}

	}



	/**
	 * Get default of section detail
	 * by load option and get default detail
	 */
	public static function default($_child = null)
	{
		if(\dash\url::module() === 'header')
		{
  			$namespace = self::header_namespace($_child);
		}
		else
		{
			$namespace = self::ganje_namespace($_child);
		}

		$namespace = sprintf($namespace, 'option');

		$full_option_list = self::_call([$namespace, 'option'], 'full');

		if(isset($full_option_list['default']) && is_array($full_option_list['default']))
		{
			return $full_option_list['default'];
		}

		return [];
	}




	/**
	 * Call layout of every section
	 *
	 * @param      <type>  $_child  The child
	 * @param      array   $_args   The arguments
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function layout($_child = null, $_args = [])
	{
		if(\dash\url::module() === 'header')
		{
  			$namespace = self::header_namespace($_child);
		}
		else
		{
			$namespace = self::ganje_namespace($_child);
		}

		$namespace = sprintf($namespace, 'layout');

		return self::_call([$namespace, 'layout'], $_args);
	}
}
?>