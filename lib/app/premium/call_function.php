<?php
namespace lib\app\premium;


class call_function
{
	/**
	 * Gets the namespace.
	 * discount_profesional > \lib\premium\items\discount\discount_profesional
	 *
	 * @param      <type>  $_premium_key  The premium key
	 *
	 * @return     <type>  The namespace.
	 */
	private static function get_namespace($_premium_key)
	{
		$folder = strtok($_premium_key, '_');

		$namespace = '\\lib\\app\\premium\\items\\'. $folder. '\\'. $_premium_key;

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
			$premium_key = $_args[0];

			$namespace = self::get_namespace($premium_key);

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