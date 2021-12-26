<?php
namespace content_a\products\barcode;


class model
{

	public static function post()
	{
		$id = \dash\request::get('id');

		$post         = [];
		$post['desc'] = \dash\request::post_html();

		$result = \lib\app\product\edit::edit($post, $id);
	}

}
?>