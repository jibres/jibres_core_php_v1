<?php
namespace content_love\gift\edit;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Edit gift card"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/view?id='. \dash\request::get('id'));

		\lib\app\gift\get::category_list();

	}
}
?>