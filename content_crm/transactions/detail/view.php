<?php
namespace content_crm\transactions\detail;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Transaction Detail"));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());



		if(\dash\data::dataRow_user_code())
		{
			$user_detail = \dash\app\user::get(\dash\data::dataRow_user_code());
			\dash\data::dataRowMember($user_detail);
			\dash\data::myUserID(\dash\data::dataRow_user_code());
		}
		else
		{
			\dash\data::myUserID(false);
		}

	}
}
?>