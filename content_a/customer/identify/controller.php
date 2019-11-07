<?php
namespace content_a\customer\identity;

class controller
{

	public static function routing()
	{
		\dash\permission::access('customerIdentifyView');
		\content_a\customer\load::check_access();
	}
}
?>