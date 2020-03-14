<?php
namespace content_cms\dayevent;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Day event chart!'));
		\dash\data::page_desc(T_('Check change of this data in date'));


		\dash\data::action_text(T_('Back to dashboard'));
		\dash\data::action_link(\dash\url::this());


		$chart = \dash\utility\dayevent::chart();
		\dash\data::cahrtDetail($chart);

	}
}
?>
