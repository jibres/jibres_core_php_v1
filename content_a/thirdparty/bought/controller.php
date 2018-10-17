<?php
namespace content_a\thirdparty\bought;

class controller
{

	public static function routing()
	{
		\content_a\thirdparty\load::check_access();
	}
}
?>