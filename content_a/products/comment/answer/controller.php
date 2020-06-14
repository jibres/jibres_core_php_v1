<?php
namespace content_a\products\comment\answer;

class controller
{

	public static function routing()
	{
		$id = \dash\request::get('cid');

		if(!$id || !\dash\coding::is($id))
		{
			\dash\header::status(404, T_("Invalid id"));
		}
	}
}
?>