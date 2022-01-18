<?php
namespace content_love\plugin\edit;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Edit plugin"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/manage?id='. \dash\request::get('id'));

	}
}
?>
