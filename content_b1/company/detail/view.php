<?php
namespace content_b1\company\detail;


class view
{
	public static function config()
	{
		$id     = \dash\request::get('id');
		$result = \lib\app\product\company::get($id);
		\content_b1\tools::say($result);
	}

}
?>