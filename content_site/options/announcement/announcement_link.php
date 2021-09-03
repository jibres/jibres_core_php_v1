<?php
namespace content_site\options\announcement;


class announcement_link
{
	use \content_site\options\link\link_professional;

	public static function db_key()
	{
		return 'announcement_link';
	}
}
?>