<?php
namespace content\subscribe;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Subscribe to Jibres world'));


		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>