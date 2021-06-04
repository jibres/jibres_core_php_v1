<?php
namespace content_love\email;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Send Email"));
		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::action_text(T_('History'));
		\dash\data::action_link(\dash\url::this(). '/history');
	}
}
?>