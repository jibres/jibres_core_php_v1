<?php
namespace content_site\assemble;


class image_size
{

	public static function detect($_args)
	{
		$container = a($_args, 'container');




		$size = 780;
		$size = 120;
		$size = 'raw';

		return $size;
	}
}
?>