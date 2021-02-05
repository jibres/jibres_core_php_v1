<?php
namespace content_b1\user\address\edit;


class model
{
	public static function patch()
	{

		$addressid = \dash\request::get('id');

		$detail = \content_b1\user\address::edit_address($addressid);

		\content_b1\tools::say($detail);
	}
}
?>