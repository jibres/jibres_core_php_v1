<?php
namespace content_b1\user\notes\remove;


class model
{
	public static function delete()
	{

		$detail = \dash\app\user\description::remove(\dash\request::get('id'), \dash\request::get('userid'));
		\content_b1\tools::say($detail);
	}
}
?>