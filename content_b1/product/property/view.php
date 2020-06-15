<?php
namespace content_b1\product\property;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

		$detail = \lib\app\product\property::get($id);

		\content_b1\tools::say($detail);
	}

}
?>