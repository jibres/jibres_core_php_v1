<?php
namespace content_site\options\quote;


class quote_text extends \content_site\options\description\description
{


	public static function db_key()
	{
		return 'text';
	}

	public static function title()
	{
		return T_("Quote");
	}
}
?>