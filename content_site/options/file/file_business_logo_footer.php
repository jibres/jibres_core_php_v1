<?php
namespace content_site\options\file;


trait file_business_logo_footer
{
	use file_business_logo;


	public static function db_key()
	{
		return 'footer_logo';
	}

	public static function title()
	{
		return T_("Footer logo");
	}

}
?>