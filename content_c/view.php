<?php
namespace content_c;


class view
{
	public static function config()
	{
		\dash\data::bodyclass('siftal');
		\dash\data::include_chart(true);

		\dash\data::display_jibresControlLayout('content_c/main/layout.html');
	}
}
?>
