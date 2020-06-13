<?php
namespace content_b1\product\remove;


class model
{
	public static function delete()
	{
		$id = \dash\request::get('id');

		$result = \lib\app\product\remove::product($id);

		\content_b1\tools::say($result);

	}


}
?>