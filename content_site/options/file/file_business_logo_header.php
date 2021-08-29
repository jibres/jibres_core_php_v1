<?php
namespace content_site\options\file;


class file_business_logo_header
{
	use file_business_logo;


	public static function db_key()
	{
		return 'header_logo';
	}

	public static function title()
	{
		return T_("Header logo");
	}

}
?>