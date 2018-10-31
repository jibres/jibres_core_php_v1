<?php
namespace content_a\chap\receipt;


class controller
{
	public static function routing()
	{
		\dash\permission::access('aFactorFishPrint');

		if(!\dash\request::get('id'))
		{
			\dash\header::status(404, T_("Id not found"));
		}
	}
}
?>
