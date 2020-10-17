<?php
namespace content_cms\dayevent;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Day event chart!'));

		\dash\data::action_text(T_('Back to dashboard'));
		\dash\data::action_link(\dash\url::this());


		$chart = \dash\app\dayevent::chart();
		\dash\data::cahrtDetail($chart);

	}
}
?>
