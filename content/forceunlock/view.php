<?php
namespace content\forceunlock;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Unlock system'));

		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>