<?php
namespace content_b1\product\next;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

		$next_id = \lib\app\product\get::next($id, true);

		\content_b1\tools::say($next_id);
	}
}
?>