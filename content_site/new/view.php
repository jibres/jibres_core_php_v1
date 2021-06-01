<?php
namespace content_site\new;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add new Page'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		if(\dash\detect\device::detectPWA())
		{
			\dash\face::btnInsert('formAddPost');
		}

	}
}
?>