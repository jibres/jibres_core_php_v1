<?php
namespace dash\waf\gate;
/**
 * dash main configure
 */
class cookie
{
	public static function inspection()
	{
		$cookie = $_COOKIE;
		// only allow array
		\dash\waf\gate\toys\only::array($cookie);

		if(empty($cookie))
		{
			return;
		}

		// save valid cookie to use in code
		$valid_cookie = [];

		// need check count of all cookie
		\dash\waf\gate\toys\general::array_count($cookie, 0, 100);

		foreach ($cookie as $key => $value)
		{
			// disallow html tags
			\dash\waf\gate\toys\block::tags($key);
			// only can be text
			\dash\waf\gate\toys\only::something($key);
			\dash\waf\gate\toys\only::text($key);


			// disallow html tags
			\dash\waf\gate\toys\block::tags($value);

			\dash\waf\gate\toys\only::text($value);

			// check key len
			\dash\waf\gate\toys\general::len($key, 1, 500);

			// check value len
			\dash\waf\gate\toys\general::len($value, 0, 10000);


			$is_valid_key = true;

			if
			(
				\dash\waf\gate\toys\contain::word($key, 'script')		 ||
				\dash\waf\gate\toys\contain::word($key, 'javascript')	 ||
				\dash\waf\gate\toys\contain::word($key, 'prompt')		 ||
				\dash\waf\gate\toys\contain::word($key, 'delete')		 ||
				\dash\waf\gate\toys\contain::word($key, 'xss')			 ||
				\dash\waf\gate\toys\contain::word($key, '{')			 ||
				\dash\waf\gate\toys\contain::word($key, '}')			 ||
				\dash\waf\gate\toys\contain::word($key, '(')			 ||
				\dash\waf\gate\toys\contain::word($key, ')')			 ||
				\dash\waf\gate\toys\contain::word($key, '<')			 ||
				\dash\waf\gate\toys\contain::word($key, '>')			 ||
				\dash\waf\gate\toys\contain::word($key, '*')			 ||
				\dash\waf\gate\toys\contain::word($key, '"')			 ||
				\dash\waf\gate\toys\contain::word($key, "'")			 ||
				\dash\waf\gate\toys\contain::word($key, "\n")
			)
			{
				$is_valid_key = false;
			}



			$is_valid_value = true;

			if
			(
				\dash\waf\gate\toys\contain::word($value, 'script')		 ||
				\dash\waf\gate\toys\contain::word($value, 'javascript')	 ||
				\dash\waf\gate\toys\contain::word($value, 'prompt')		 ||
				\dash\waf\gate\toys\contain::word($value, 'delete')		 ||
				\dash\waf\gate\toys\contain::word($value, 'xss')		 ||
				\dash\waf\gate\toys\contain::word($value, '<')			 ||
				\dash\waf\gate\toys\contain::word($value, '>')			 ||
				\dash\waf\gate\toys\contain::word($value, '*')			 ||
				\dash\waf\gate\toys\contain::word($value, '"')			 ||
				\dash\waf\gate\toys\contain::word($value, "'")			 ||
				\dash\waf\gate\toys\contain::word($value, "\n")
			)
			{
				$is_valid_value = false;
			}



			if($is_valid_key && $is_valid_value)
			{
				$valid_cookie[$key] = $value;
			}

		}


		\dash\utility\cookie::force_set_cookie($valid_cookie);
	}

}
?>