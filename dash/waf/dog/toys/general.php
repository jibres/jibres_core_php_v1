<?php
namespace dash\waf\dog\toys;
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
			\dash\header::status(428, 'No < '. $myLen);
		}
		if($myLen > $_max)
		{
			\dash\header::status(428, 'No > '. $myLen);
		}
	}


	public static function mb_len($_text, $_min, $_max)
	{
		$myLen = mb_strlen($_text);
		if($myLen < $_min)
		{
			\dash\header::status(428, 'No < '. $myLen);
		}
		if($myLen > $_max)
		{
			\dash\header::status(428, 'No > '. $myLen);
		}
	}



	public static function array_count($_array, $_min, $_max)
	{
		$count = count($_array);
		if($count < $_min)
		{
			\dash\header::status(428, 'No < '. $count);
		}
		if($count > $_max)
		{
			\dash\header::status(428, 'No > '. $count);
		}
	}

}
?>
