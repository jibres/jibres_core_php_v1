<?php
namespace content_a\category\property;

class controller extends \content_a\category\edit\controller
{
	public static function routing()
	{

		parent::routing();
		// disable allow file
		\dash\allow::file(false);


	}
}
?>