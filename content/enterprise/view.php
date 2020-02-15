<?php
namespace content\enterprise;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Enterprise'));
		\dash\data::page_desc(T_('Have a headaches? We have soulutions. Be patient...'));

		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>