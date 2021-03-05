<?php
namespace dash\waf\dog;

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

		// only can be text
		\dash\waf\dog\toys\only::text($phpinput);

		\dash\waf\dog\toys\general::len($phpinput, 0, 50000); // for api add post by content

		// all post request have php input
		// \dash\waf\dog\toys\only::json($phpinput);


	}

}
?>
