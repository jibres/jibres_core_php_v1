<?php
namespace content_love\gift\view;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Edit gift card"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


		// btn
		\dash\data::action_text(T_('Edit gift card'));
		\dash\data::action_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));

	}
}
?>