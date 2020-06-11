<?php
namespace content_a\cart\user;


class view
{
	public static function config()
	{

		\dash\face::title(T_('Choose user'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>
