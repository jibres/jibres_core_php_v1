<?php
namespace content_site\options\quote;


class quote_title
{
	use \content_site\options\title\title;

	public static function db_key()
	{
		return 'title';
	}

	public static function title()
	{
		return T_("Title");
	}
}
?>