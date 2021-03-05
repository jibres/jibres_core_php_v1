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
			\dash\header::status(428, 'Disallow 1');
		}

		$myTxt = urldecode($myTxt);
		if(strpos($myTxt, $_find) !== false)
		{
			\dash\header::status(428, 'Disallow 2');
		}

		$myTxt = urldecode($myTxt);
		if(strpos($myTxt, $_find) !== false)
		{
			\dash\header::status(428, 'Disallow 3');
		}

		$myTxt = urldecode($myTxt);
		if(strpos($myTxt, $_find) !== false)
		{
			\dash\header::status(428, 'Disallow 4');
		}

		$myTxt = urldecode($myTxt);
		if(strpos($myTxt, $_find) !== false)
		{
			\dash\header::status(428, 'Disallow 5');
		}
	}


	public static function tags($_text)
	{
		$strippedText = strip_tags($_text);
		if($_text !== $strippedText)
		{
			\dash\header::status(428, 'ooh Tag!');
		}
	}


	public static function key_exists($_key, $_array)
	{
		if(array_key_exists($_key, $_array))
		{
			\dash\header::status(428, 'Disallow index!');
		}
	}
}
?>
