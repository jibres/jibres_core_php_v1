<?php
namespace content_b1\user\address\remove;


class model
{
	public static function delete()
	{
		$id = \dash\request::get('id');

		$detail = \content_b1\user\address::remove_address($id);

		\content_b1\tools::say($detail);
	}
}
?>