<?php
namespace content_a\products\desc;


class model
{

	public static function post()
	{
		$id = \dash\request::get('id');

		$post         = [];
		$post['desc'] = isset($_POST['desc']) ? $_POST['desc'] : null;

		$result = \lib\app\product\edit::edit($post, $id);
	}

}
?>