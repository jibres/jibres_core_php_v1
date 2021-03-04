<?php
namespace content_cms\files\add;

class controller
{
	public static function routing()
	{
		\dash\permission::access('cmsAttachmentAdd');

		\dash\allow::file();
	}
}
?>