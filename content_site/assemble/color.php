<?php
namespace content_site\assemble;


class color
{

	public static function rgb($_hex)
	{
		if(is_string($_hex))
		{
			list($r, $g, $b) = sscanf($_hex, "#%02x%02x%02x");
			return "$r, $g, $b";
		}

	}




	/**
	 * Get all style in backgroun
	 *
	 * @param      <type>  $_data  The backgroun pack array
	 */
	public static function style($_data, $_index)
	{
		$style = [];

		$color_text       = a($_data,  $_index);

		if($color_text)
		{
			$style[] = 'color:'. $color_text;
		}

		return implode(' ', $style);
	}
}
?>