<?php
namespace content_a\pagebuilder\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add new page'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		if(\dash\detect\device::detectPWA())
		{
			\dash\face::btnInsert('formAddPost');
		}

	}
}
?>