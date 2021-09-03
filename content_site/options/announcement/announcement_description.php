<?php
namespace content_site\options\announcement;


class announcement_description
{
	use \content_site\options\description\description;

	public static function db_key()
	{
		return 'announcement_description';
	}
}
?>