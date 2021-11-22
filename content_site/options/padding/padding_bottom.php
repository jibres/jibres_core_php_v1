<?php
namespace content_site\options\padding;


class padding_bottom
{
	use padding;

	public static function title()
	{
		return T_("Padding bottom");
	}

	public static function name()
	{
		return 'padding_bottom';
	}

	public static function db_key()
	{
		return 'padding_bottom';
	}


}
?>