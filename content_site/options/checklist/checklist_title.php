<?php
namespace content_site\options\checklist;


class checklist_title extends \content_site\options\title\title
{


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