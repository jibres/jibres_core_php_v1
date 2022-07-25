<?php
namespace content_site\page\duplicate;


class controller extends \content_site\page\controller
{
	public static function routing()
	{
		parent::routing();

		\dash\allow::file();
	}
}
?>