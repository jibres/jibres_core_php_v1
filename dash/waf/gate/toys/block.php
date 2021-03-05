<?php
namespace dash\waf\gate\toys;
/**
 * dash main configure
 */
class block
{
	public static function word($_text, $_find)
	{
		$myTxt = $_text;
		if(strpos($myTxt, $_find) !== false)
		{
			\dash\waf\dog::BITE('Disallow l1 '. $_find, 428);
		}

		$myTxt = urldecode($myTxt);
		if(strpos($myTxt, $_find) !== false)
		{
			\dash\waf\dog::BITE('Disallow l2 '. $_find, 428);
		}

		$myTxt = urldecode($myTxt);
		if(strpos($myTxt, $_find) !== false)
		{
			\dash\waf\dog::BITE('Disallow l3 '. $_find, 428);
		}

		$myTxt = urldecode($myTxt);
		if(strpos($myTxt, $_find) !== false)
		{
			\dash\waf\dog::BITE('Disallow l4 '. $_find, 428);
		}

		$myTxt = urldecode($myTxt);
		if(strpos($myTxt, $_find) !== false)
		{
			\dash\waf\dog::BITE('Disallow l5 '. $_find, 428);
		}
	}


	public static function tags($_text, $_from = null)
	{
		if($_from	=== 'Booster_resultXML')
		{
			// @TODO
			// need to fix
			// used on jibres booster
			return null;
		}

		$strippedText = strip_tags($_text);
		if($_text !== $strippedText)
		{
			$msg = 'ooh Tag! ';
			if($_from)
			{
				$msg = 'ooh Tag inside '. $_from;
			}
			\dash\waf\dog::BITE($msg, 428);
		}
	}


	public static function key_exists($_key, $_array)
	{
		if(array_key_exists($_key, $_array))
		{
			\dash\waf\dog::BITE('Disallow index!', 428);
		}
	}
}
?>
