<?php
namespace dash\engine\dog\toys;
/**
 * dash main configure
 */
class block
{
	public static function word($_text, $_find)
	{
		if(strpos($_text, $_find))
		{
			\dash\header::status(428, 'Disallow');
		}

	}
}
?>
