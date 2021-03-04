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

		\dash\engine\dog\toys\general::len($phpinput, 1, 50000); // for api add post by content

		$phpinput = json_decode($phpinput, true);

		\dash\engine\dog\toys\only::array($phpinput);
	}

}
?>
