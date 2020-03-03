<?php
namespace content_v2\product\detail;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');
		$detail = \lib\app\product\load::one($id);
		\content_v2\tools::say($detail);
	}

}
?>