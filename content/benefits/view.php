<?php
namespace content\benefits;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Jibres benefits'));
		\dash\data::page_desc(T_('What can you do with Jibres?'));

		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>