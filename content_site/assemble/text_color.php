<?php
namespace content_site\assemble;


class text_color
{


	public static function full_style($_data)
	{
		$style = self::style($_data);

		return "style='$style' ";
	}


	/**
	 * Get all style in backgroun
	 *
	 * @param      <type>  $_data  The backgroun pack array
	 */
	public static function style($_data)
	{
		$style = [];

		$color_text       = a($_data,  'color_text');

		if($color_text)
		{
			$style[] = 'color:'. $color_text;
		}

		return implode(' ', $style);
	}
}
?>