<?php
namespace content_a\website\quote\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add quote'));


		if(\dash\data::quoteID())
		{
			\dash\face::btnSetting(\dash\url::this(). '/quote/setting?id='. \dash\data::quoteID());


			if(\dash\data::lineSetting_quote() && is_array(\dash\data::lineSetting_quote()))
			{
				// back
				\dash\data::back_text(T_('Quote list'));
				\dash\data::back_link(\dash\url::that(). '?id='. \dash\data::quoteID());

			}
			else
			{
				// back
				\dash\data::back_text(T_('Website body'));
				\dash\data::back_link(\dash\url::this(). '/body');
			}
		}
		else
		{
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this(). '/body');
			\dash\face::btnSetting(\dash\url::this(). '/quote/setting');
		}
	}
}
?>
