<?php
namespace content_b1\tags\remove;


class model
{

	public static function delete()
	{
		$result = \dash\app\terms\remove::remove(\dash\request::get('id'));

		\content_b1\tools::say($result);
	}
}
?>