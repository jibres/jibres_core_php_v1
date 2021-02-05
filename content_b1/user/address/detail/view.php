<?php
namespace content_b1\user\address\detail;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

		$detail = \content_b1\user\address::get_address($id);

		\content_b1\tools::say($detail);
	}
}
?>