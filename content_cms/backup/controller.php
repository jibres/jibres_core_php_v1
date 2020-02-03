<?php
namespace content_cms\backup;

class controller
{
	public static function routing()
	{
		if(\dash\permission::supervisor())
		{
			// no problem if the user have permission
			\dash\permission::access('cpBackup');
		}
		else
		{
			\dash\header::status(403);
		}
	}
}
?>