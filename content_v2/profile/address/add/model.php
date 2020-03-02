<?php
namespace content_v2\profile\address\add;


class model
{
	public static function post()
	{
		\content_v2\user\address::set_user_id(\dash\user::id());
		$profile = \content_v2\user\address::add_address();
		\content_v2\tools::say($profile);
	}

}
?>