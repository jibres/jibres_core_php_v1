<?php
namespace content_a\website\text;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Text'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/body');


		if(\dash\data::textID())
		{
			\dash\face::btnSetting(\dash\url::this(). '/text/setting?id='. \dash\data::textID());
		}
	}
}
?>
