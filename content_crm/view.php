<?php
namespace content_crm;

class view
{
	public static function config()
	{
		\dash\data::include_adminPanel(true);

		\dash\upload\size::set_default_file_size('crm');


		// \dash\data::include_m2(true);
	}
}
?>