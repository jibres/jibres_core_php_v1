<?php
namespace content_v2\product\remove;


class model
{
	public static function delete()
	{
		$id = \dash\request::get('id');

		$result = \lib\app\product\remove::product($id);

		\content_v2\tools::say($result);

	}


}
?>