<?php
namespace content_a\irvat\edit;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Edit gift card"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/view?id='. \dash\request::get('id'));


	}
}
?>