<?php
namespace dash\engine\dog\toys;
/**
 * dash main configure
 */
class general
{
	public static function len($_text, $_min, $_max)
	{
		$myLen = strlen($_text);
		if($myLen < $_min)
		{
			\dash\header::status(428, 'No <');
		}
		if($myLen > $_max)
		{
			var_dump($_max);
			\dash\header::status(428, 'No >'. $_text);
		}
	}


	public static function mb_len($_text, $_min, $_max)
	{
		$myLen = mb_strlen($_text);
		if($myLen < $_min)
		{
			\dash\header::status(428, 'No <');
		}
		if($myLen > $_max)
		{
			\dash\header::status(428, 'No >');
		}
	}

}
?>
