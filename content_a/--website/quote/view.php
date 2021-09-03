<?php
namespace content_a\website\quote;


class view
{
	public static function config()
	{
		if(\dash\data::lineSetting_title() && !\dash\detect\device::detectPWA())
		{
			\dash\face::title(\dash\data::lineSetting_title());
		}
		else
		{
			\dash\face::title(T_('Quote'));
		}

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/body');


		if(\dash\data::quoteID())
		{
			\dash\face::btnSetting(\dash\url::this(). '/quote/setting?id='. \dash\data::quoteID());
			// action
			\dash\data::action_text(T_('Add quote'));
			\dash\data::action_link(\dash\url::this(). '/quote/add?id='. \dash\data::quoteID());
		}


		if(\dash\data::lineSetting_quote() && is_array(\dash\data::lineSetting_quote()))
		{
			$quote = \dash\data::lineSetting_quote();
			foreach ($quote as $key => $value)
			{
				$quote[$key]['edit_link'] = \dash\url::this(). '/quote/edit?id='. \dash\data::quoteID(). '&index='. $key;
			}

			\dash\data::lineSetting_quote($quote);
		}
		else
		{
			\dash\redirect::to(\dash\url::this(). '/quote/add?id='. \dash\data::quoteID());
		}
	}
}
?>
