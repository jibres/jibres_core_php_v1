<?php
namespace content_love\business\statistics;

class view
{
	public static function config()
	{
		\dash\face::title(T_('statistics'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>