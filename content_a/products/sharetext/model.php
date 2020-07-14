<?php
namespace content_a\products\sharetext;


class model
{

	public static function post()
	{
		$id = \dash\request::get('id');

		$post         = [];
		$post['sharetext'] = isset($_POST['sharetext']) ? $_POST['sharetext'] : null;

		$result = \lib\app\product\edit::edit($post, $id);
	}

}
?>