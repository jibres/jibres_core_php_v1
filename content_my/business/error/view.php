<?php
namespace content_my\business\error;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Oops!"));

		\dash\data::userToggleSidebar(false);

		$error = \dash\session::get('createNewStore_error', 'CreateNewStore');

		if(isset($error['code']))
		{
			\dash\data::StoreCreateErrorCode($error['code']);
		}

		if(\dash\detect\device::detectPWA())
		{
			// back
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this());
		}
	}
}
?>