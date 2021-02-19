<?php
namespace content_love\files\add;

class controller
{
	public static function routing()
	{
		\dash\permission::access('cmsAttachmentAdd');
	}
}
?>