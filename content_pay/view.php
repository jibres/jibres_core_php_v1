<?php
namespace content_pay;

class view
{
	public static function config()
	{
		\dash\data::include_adminPanel(true);

		\dash\data::userToggleSidebar(false);
	}
}
?>