<?php
namespace content_a\products\sharetext;


class model
{

	public static function post()
	{
		$id = \dash\request::get('id');

		$post         = [];
		$post['sharetext'] = \dash\request::post('sharetext');

		$result = \lib\app\product\edit::edit($post, $id);
	}

}
?>