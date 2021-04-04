<?php
namespace dash\waf\gate\toys;
/**
 * dash main configure
 */
class general
{
	public static function len($_text, $_min, $_max)
	{
		if(!is_string($_text) && !is_numeric($_text))
		{
			\dash\waf\dog::BITE('only T/N on len', 428);
		}

		// convert numeric to string
		if(is_numeric($_text))
		{
			$_text = (string) $_text;
		}

		$myLen = strlen($_text);
		if($myLen < $_min)
		{
			\dash\waf\dog::BITE('No '. $myLen. '<'. $_min, 428);
		}
		if($myLen > $_max)
		{
			\dash\waf\dog::BITE('No '. $myLen. '>'. $_max, 428);
		}
	}


	public static function mb_len($_text, $_min, $_max)
	{
		if(!is_string($_text) && !is_numeric($_text))
		{
			\dash\waf\dog::BITE('only T/N on len', 428);
		}

		// convert numeric to string
		if(is_numeric($_text))
		{
			$_text = (string) $_text;
		}

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
