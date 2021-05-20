<?php
namespace content_crm\transactions\edit;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Edit Transaction"));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/detail'. \dash\request::full_get(['id' => \dash\request::get('id')]));


		if(\dash\data::dataRow_user_code())
		{
			$user_detail = \dash\app\user::get(\dash\data::dataRow_user_code());
			\dash\data::dataRowMember($user_detail);
			\dash\data::myUserID(\dash\data::dataRow_user_code());
		}


	}
}
?>