<?php
namespace lib\app\plugin;


class call_function
{
	/**
	 * Gets the namespace.
	 * discount_profesional > \lib\app\plugin\items\discount\discount_profesional
	 *
	 * @param      <type>  $_plugin_key  The plugin key
	 *
	 * @return     <type>  The namespace.
	 */
	private static function get_namespace($_plugin_key)
	{
		$folder = strtok($_plugin_key, '_');

		$namespace = '\\lib\\app\\plugin\\items\\'. $folder. '\\'. $_plugin_key;

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
			$plugin_key = $_args[0];

			$namespace = self::get_namespace($plugin_key);

			if(is_callable([$namespace, $_function]))
			{
				$result = call_user_func([$namespace, $_function]);
				return $result;
			}

		}

		return false;


	}
}
?>