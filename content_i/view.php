<?php
namespace content_i;

class view
{
	public static function config()
	{
		\dash\data::include_adminPanel(true);
		\dash\data::include_highcharts(true);
		\dash\data::include_editor(true);
		\dash\data::badge_shortkey(120);
		\dash\data::badge2_shortkey(121);
	}
}
?>