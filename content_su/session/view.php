<?php
namespace content_su\session;


class view
{
	public static function config()
	{
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		if(isset($_SESSION))
		{
			\dash\data::session($_SESSION);
		}
	}
}
?>