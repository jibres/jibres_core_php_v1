<?php
namespace content_v2\profile\address\fetch;


class view
{
	public static function config()
	{
		\content_v2\user\address::set_user_id(\dash\user::id());
		$profile = \content_v2\user\address::list_address();
		\content_v2\tools::say($profile);
	}
}
?>