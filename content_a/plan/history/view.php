<?php
namespace content_a\plan\history;


use lib\app\plan\planCheck;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Plan history"));

		// back
		\dash\data::back_text(T_('Plan'));
		\dash\data::back_link(\dash\url::this());





	}
}
?>
