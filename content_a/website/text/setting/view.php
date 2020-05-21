<?php
namespace content_a\website\text\setting;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Manage text'));

		if(\dash\data::textID())
		{
			// back
			\dash\data::back_text(T_('Text list'));
			\dash\data::back_link(\dash\url::that(). '?id='. \dash\data::textID());
		}
		else
		{
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this());
		}

	}
}
?>
