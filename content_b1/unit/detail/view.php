<?php
namespace content_b1\unit\detail;


class view
{
	public static function config()
	{
		$id     = \dash\request::get('id');
		$result = \lib\app\product\unit::get($id);
		\content_b1\tools::say($result);
	}

}
?>