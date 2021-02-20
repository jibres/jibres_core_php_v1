<?php
namespace content_crm\ticket\assign;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Assing ticket to user"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/view?id='.\dash\request::get('id'));

	}
}
?>
