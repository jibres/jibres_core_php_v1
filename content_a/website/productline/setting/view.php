<?php
namespace content_a\website\productline\setting;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Manage productline'));

		if(\dash\data::productlineID())
		{
			// back
			\dash\data::back_text(T_('Productline list'));
			\dash\data::back_link(\dash\url::that(). '?id='. \dash\data::productlineID());
		}
		else
		{
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this());
		}

	}
}
?>
