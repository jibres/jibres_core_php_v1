<?php
namespace content_crm\member\message\add;


class view
{
	public static function config()
	{

		\content_crm\member\master::view();

		\dash\face::title(T_('Add new notification'));

		\dash\data::back_link(\dash\url::that(). \dash\request::full_get());
		\dash\data::back_text(T_("Back"));
	}
}
?>
