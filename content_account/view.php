<?php
namespace content_account;

class view
{
	public static function config()
	{
		\dash\data::include_adminPanel(true);

		\dash\data::include_editor(true);

		// \dash\data::page_titleBox(true);
	}
}
?>