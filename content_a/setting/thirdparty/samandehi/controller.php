<?php
namespace content_a\setting\thirdparty\samandehi;

class controller extends \content_a\setting\home\controller
{
	public static function routing()
	{
		parent::routing();

		\dash\allow::html();
	}
}
?>