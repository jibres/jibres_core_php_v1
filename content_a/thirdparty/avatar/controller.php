<?php
namespace content_a\thirdparty\avatar;

class controller
{

	public static function routing()
	{
		\dash\permission::access('thirdpartyAvatarSet');
	}
}
?>