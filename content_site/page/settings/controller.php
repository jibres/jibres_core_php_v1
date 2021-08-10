<?php
namespace content_site\page\settings;


class controller extends \content_site\page\controller
{
	public static function routing()
	{
		parent::routing();

		\dash\allow::file();
	}
}
?>