<?php
namespace content_a\website\body\slider;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Manage slider'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/body');

		if(!\dash\data::savedOption())
		{
			$saved_option = \lib\app\website\body\slider::get(\dash\request::get('key'));
			\dash\data::savedOption($saved_option);
		}

	}
}
?>
