<?php
namespace content_a\customer\comment;

class controller
{
	public static function routing()
	{
		\dash\permission::access('customerNoteView');
		\content_a\customer\load::check_access();
	}
}
?>