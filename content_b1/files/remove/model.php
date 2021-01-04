<?php
namespace content_b1\files\remove;


class model
{

	public static function delete()
	{
		$result = \dash\app\files\remove::remove(\dash\request::get('id'));

		\content_b1\tools::say($result);
	}
}
?>