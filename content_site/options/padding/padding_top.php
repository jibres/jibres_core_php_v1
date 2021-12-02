<?php
namespace content_site\options\padding;


class padding_top extends padding
{
	public static function title()
	{
		return T_("Padding Top");
	}

	public static function name()
	{
		return 'padding_top';
	}

	public static function db_key()
	{
		return 'padding_top';
	}


}
?>