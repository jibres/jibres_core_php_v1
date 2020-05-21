<?php
namespace content_a\website\productline;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Productline'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/body');


		if(\dash\data::productlineID())
		{
			\dash\face::btnSetting(\dash\url::this(). '/productline/setting?id='. \dash\data::productlineID());
		}
	}
}
?>
