<?php
namespace content_a\setting\general\nosale;


class model
{
	public static function post()
	{
		$post               = [];

		$post['nosale'] = \dash\request::post('nosale');

		\lib\app\setting\set::nosale_setting($post);

		\dash\redirect::pwd();
	}


}
?>