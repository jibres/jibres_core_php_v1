<?php
namespace content_b1\posts\remove;


class model
{

	public static function delete()
	{
		$result = \dash\app\posts\remove::remove(\dash\request::get('id'));

		\content_b1\tools::say($result);
	}

}
?>