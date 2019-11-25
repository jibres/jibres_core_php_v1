<?php
namespace content_a\customer\general;

class controller
{

	public static function routing()
	{
		\content_a\customer\load::check_access();
	}
}
?>