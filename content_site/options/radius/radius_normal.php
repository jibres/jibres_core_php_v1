<?php
namespace content_site\options\radius;


class radius_normal
{
	use radius;

	public static function enum_type()
	{
		return 'normal';
	}

	public static function option_key()
	{
		return 'radius_normal';
	}

}
?>