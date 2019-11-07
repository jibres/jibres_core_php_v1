<?php
namespace content_a\customer\tag;

class controller
{
	public static function routing()
	{
		\dash\permission::access('customerTagView');
		\content_a\customer\load::check_access();
	}
}
?>