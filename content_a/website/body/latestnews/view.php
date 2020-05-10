<?php
namespace content_a\website\body\latestnews;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Manage latest news'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/body');

		$saved_option = \lib\app\website\body\latestnews::get(\dash\request::get('key'));
		\dash\data::savedOption($saved_option);
	}
}
?>
