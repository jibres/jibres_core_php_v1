<?php
namespace content_a\products\bullet;


class model
{

	public static function post()
	{
		$id             = \dash\request::get('id');

		$post           = [];

		$post['bullet'] = \dash\request::post('bullet');

		$result = \lib\app\product\bullet::add($post, $id);

		if($result && \dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}

}
?>