<?php
namespace content_v2\profile\address\remove;


class model
{

	public static function delete()
	{
		$id = \dash\request::get('id');
		\content_v2\user\address::set_user_id(\dash\user::id());
		$profile = \content_v2\user\address::remove_address($id);
		\content_v2\tools::say($profile);

	}


}
?>