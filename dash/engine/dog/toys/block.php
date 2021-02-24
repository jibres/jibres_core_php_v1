<?php
namespace dash\engine\dog\toys;
/**
 * dash main configure
 */
class block
{
	public static function word($_text, $_find)
	{
		$myTxt = $_text;
		if(strpos($myTxt, $_find))
		{
			\dash\header::status(428, 'Disallow 1');
		}

		$myTxt = urldecode($myTxt);
		if(strpos($myTxt, $_find))
		{
			\dash\header::status(428, 'Disallow 2');
		}

		$myTxt = urldecode($myTxt);
		if(strpos($myTxt, $_find))
		{
			\dash\header::status(428, 'Disallow 3');
		}

		$myTxt = urldecode($myTxt);
		if(strpos($myTxt, $_find))
		{
			\dash\header::status(428, 'Disallow 4');
		}

		$myTxt = urldecode($myTxt);
		if(strpos($myTxt, $_find))
		{
			\dash\header::status(428, 'Disallow 5');
		}
	}
}
?>
