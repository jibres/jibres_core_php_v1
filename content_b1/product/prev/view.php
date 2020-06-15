<?php
namespace content_b1\product\prev;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

		$prev_id = \lib\app\product\get::prev($id, true);

		\content_b1\tools::say($prev_id);
	}
}
?>