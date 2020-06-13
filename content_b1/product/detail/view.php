<?php
namespace content_b1\product\detail;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');
		$detail = \lib\app\product\load::one($id);
		\content_b1\tools::say($detail);
	}

}
?>