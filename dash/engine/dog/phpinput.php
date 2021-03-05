<?php
namespace dash\engine\dog;

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
		\dash\engine\dog\toys\only::text($phpinput);

		\dash\engine\dog\toys\general::len($phpinput, 0, 50000); // for api add post by content

		// all post request have php input
		// \dash\engine\dog\toys\only::json($phpinput);


	}

}
?>
