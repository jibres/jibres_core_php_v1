<?php
namespace content_crm\notification\view;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Show detail"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/datalist');

		if(\dash\data::dataRow_to_user())
		{
			\dash\data::toUserDetail(\dash\app\user::get(\dash\data::dataRow_to_user()));
		}

	}
}
?>
