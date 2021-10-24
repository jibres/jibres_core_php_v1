<?php
namespace lib\features;


class call_function
{
	private static function get_namespace($_feature)
	{
		$namespace = '\\lib\\features\\items\\'. $_feature;

		return $namespace;
	}


	public static function __callStatic($_function, $_args)
	{
		if(isset($_args[0]) && is_string($_args[0]))
		{
			$feature_key = $_args[0];

			$namespace = self::get_namespace($feature_key);


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