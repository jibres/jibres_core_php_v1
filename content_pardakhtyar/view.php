<?php
namespace content_pardakhtyar;


class view
{
	public static function config()
	{
		\dash\data::include_adminPanel(true);
		\dash\data::include_css(true);
		\dash\data::include_js(true);

		\dash\data::include_highcharts(true);
		// set shortkey for all badges is this content
		\dash\data::badge_shortkey(120);
		\dash\data::badge2_shortkey(121);
	}
}
?>
