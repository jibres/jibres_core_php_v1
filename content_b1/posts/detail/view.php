<?php
namespace content_b1\posts\detail;


class view
{

	public static function config()
	{
		$result = \dash\app\posts\get::load_post(\dash\request::get('id'));

		\content_b1\tools::say($result);
	}

}
?>