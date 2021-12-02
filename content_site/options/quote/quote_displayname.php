<?php
namespace content_site\options\quote;


class quote_displayname extends \content_site\options\title\title
{


	public static function db_key()
	{
		return 'displayname';
	}

	public static function title()
	{
		return T_("Author displayname");
	}
}
?>