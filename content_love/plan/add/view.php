<?php
namespace content_love\plan\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Add plan"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '?business_id='. \dash\request::get('business_id'));

		\dash\data::planList(\lib\app\plan\planList::list());





	}
}
?>
