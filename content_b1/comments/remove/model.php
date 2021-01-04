<?php
namespace content_b1\comments\remove;


class model
{

	public static function delete()
	{
		$result = \dash\app\comment\remove::remove(\dash\request::get('id'));

		\content_b1\tools::say($result);
	}
}
?>