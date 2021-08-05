<?php
namespace content_site\assemble;


class font
{


	public static function full_class($_data)
	{
		$class = self::class($_data);
		if($class)
		{
			$class = "class='$class' ";
		}
		return $class;
	}


	/**
	 * Get all style in backgroun
	 *
	 * @param      <type>  $_data  The backgroun pack array
	 */
	public static function class($_data)
	{
		$class = [];

		$color_text       = a($_data,  'font');

		if($color_text)
		{
			$class[] = 'font-'. $color_text;
		}

		return implode(' ', $class);
	}
}
?>