<?php
namespace content_love\sms\charge\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Plus minus business charge"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());

	}
}
?>
