<?php
namespace content_business\tag;

class controller
{
	public static function routing()
	{
		$child = \dash\url::child();

		if($child)
		{
			// default route
			return false;
		}



	}
}
?>