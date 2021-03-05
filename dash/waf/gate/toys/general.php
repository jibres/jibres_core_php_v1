<?php
namespace dash\waf\gate\toys;
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
			\dash\waf\dog::BITE('No '. $myLen. '<'. $_min, 428);
		}
		if($myLen > $_max)
		{
			\dash\waf\dog::BITE('No '. $myLen. '>'. $_max. ' - '. $_text, 428);
		}
	}


	public static function mb_len($_text, $_min, $_max)
	{
		$myLen = mb_strlen($_text);
		if($myLen < $_min)
		{
			\dash\waf\dog::BITE('mNo '. $myLen. '<'. $_min, 428);
		}
		if($myLen > $_max)
		{
			\dash\waf\dog::BITE('mNo '. $myLen. '>'. $_max, 428);
		}
	}



	public static function array_count($_array, $_min, $_max)
	{
		$count = count($_array);
		if($count < $_min)
		{
			\dash\waf\dog::BITE('Arr '. $count. '<'. $_min, 428);
		}
		if($count > $_max)
		{
			\dash\waf\dog::BITE('Arr '. $count. '>'. $_max, 428);
		}
	}

}
?>
