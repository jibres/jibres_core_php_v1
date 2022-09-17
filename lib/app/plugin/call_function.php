<?php
namespace lib\app\plugin;


class call_function
{
	/**
	 * Gets the namespace.
	 *
	 *
	 * @param      <type>  $_plugin  The plugin key
	 *
	 * @return     <type>  The namespace.
	 */
	private static function get_namespace($_plugin)
	{
		$folder = strtok($_plugin, '_');

		$namespace = '\\lib\\app\\plugin\\items\\'. $folder. '\\'. $_plugin;

		return $namespace;
	}


	/**
	 * Call function
	 *
	 * @param      <type>  $_function  The function
	 * @param      <type>  $_args      The arguments
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	public static function __callStatic($_function, $_args)
	{
		if(isset($_args[0]) && is_string($_args[0]))
		{
			$plugin = $_args[0];

			$namespace = self::get_namespace($plugin);

			if(is_callable([$namespace, $_function]))
			{
				$result = call_user_func([$namespace, $_function]);
				return $result;
			}
			else
			{
				trigger_error('Plugin function not exists! ('. $_function. ')');
			}

		}

		return false;


	}
}
?>