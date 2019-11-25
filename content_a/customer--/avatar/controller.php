<?php
namespace content_a\customer\avatar;

class controller
{

	public static function routing()
	{
		\dash\permission::access('customerAvatarSet');
		\content_a\customer\load::check_access();
	}
}
?>