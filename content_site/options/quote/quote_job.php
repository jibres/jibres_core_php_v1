<?php
namespace content_site\options\quote;


class quote_job extends \content_site\options\title\title
{


	public static function db_key()
	{
		return 'job';
	}

	public static function title()
	{
		return T_("Job title");
	}
}
?>