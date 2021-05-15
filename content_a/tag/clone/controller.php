<?php
namespace content_a\tag\clone;

class controller extends \content_a\tag\edit\controller
{
	public static function routing()
	{
		parent::routing();

		// disable allow file
		\dash\allow::file(false);

	}
}
?>