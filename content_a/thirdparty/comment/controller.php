<?php
namespace content_a\thirdparty\comment;

class controller
{
	public static function routing()
	{
		\dash\permission::access('thirdpartyNoteView');
		\content_a\thirdparty\load::check_access();
	}
}
?>