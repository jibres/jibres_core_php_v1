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
}
?>
