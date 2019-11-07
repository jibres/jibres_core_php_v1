<?php
namespace content_a\thirdparty\identity;

class controller
{

	public static function routing()
	{
		\dash\permission::access('thirdpartyIdentifyView');
		\content_a\thirdparty\load::check_access();
	}
}
?>