<?php
namespace content_love\business\datecreate;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Store analytics"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$chartDetail = \lib\app\store\stats_monthly::chart_datecreated();
		\dash\data::chartDetail($chartDetail);

	}
}
?>
