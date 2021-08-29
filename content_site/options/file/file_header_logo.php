<?php
namespace content_site\options\file;


class file_header_logo
{
	use file_logo;


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