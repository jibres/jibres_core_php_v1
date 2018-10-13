<?php
namespace content_a\thirdparty\tag;

class controller
{
	public static function routing()
	{
		\dash\permission::access('thirdpartyTagView');
	}
}
?>