<?php
namespace content_site\options\radius;


class radius_full
{
	use radius;

	public static function enum_type()
	{
		return 'full';
	}

	public static function option_key()
	{
		return 'radius_full';
	}

}
?>