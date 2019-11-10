<?php
namespace content_store\error;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Oops!"));

		\dash\data::userToggleSidebar(false);

		$error = \dash\session::get('createNewStore_error', 'CreateNewStore');

		if(isset($error['code']))
		{
			\dash\data::StoreCreateErrorCode($error['code']);
		}
	}
}
?>