<?php
namespace content_a\setting\general\nosale;


class model
{
	public static function post()
	{
		$post               = [];

		$post['nosale'] = \dash\request::post('nosale');

		\lib\app\store\edit::selfedit($post);

		\dash\redirect::pwd();
	}


}
?>