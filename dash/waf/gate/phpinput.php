<?php
namespace dash\waf\gate;

/**
 * This class describes a phpinput.
 */
class phpinput
{
	public static function inspection()
	{
		$phpinput = @file_get_contents('php://input');

		if(!$phpinput)
		{
			return;
		}

		if(\dash\url::is_api())
		{
			// only can be text
			\dash\waf\gate\toys\only::text($phpinput);

			\dash\waf\gate\toys\general::len($phpinput, 0, 50000); // for api add post by content

			$phpinput = \dash\waf\gate\toys\only::json($phpinput);

			foreach ($phpinput as $key => $value)
			{
				post::check_key($key);

				if($key === 'html')
				{
					post::check_value($value, $key, true);
				}
				else
				{
					post::check_value($value, $key);
				}
			}
		}
		else
		{
			$phpinput = null;
		}

		\dash\request::force_set_php_input($phpinput);

	}

}
?>
