<?php
namespace content_v2\profile\address\edit;


class model
{
	public static function patch()
	{
		$id = \dash\request::get('id');

		$dataRow = \dash\app\address::get_user_address(\dash\user::id(), $id);
		if(!$dataRow)
		{
			\dash\header::status(403, T_("This is not your address"));
		}

		\content_v2\user\address::set_user_id(\dash\user::id());
		$profile = \content_v2\user\address::edit_address($id);
		\content_v2\tools::say($profile);

	}
}
?>