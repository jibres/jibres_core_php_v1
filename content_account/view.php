<?php
namespace content_account;

class view
{
	public static function config()
	{
		\dash\data::include_adminPanel(true);

		// \dash\face::boxTitle(true);
		\dash\upload\size::set_default_file_size('account');
	}
}
?>