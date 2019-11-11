<?php
namespace content_api;


class controller
{
	public static function routing()
	{
		$module = \dash\url::module();

		if(!$module || ($module === 'doc' && !\dash\url::child()) || (in_array($module, ['v6'])))
		{
			// nothing
		}
		else
		{
			\dash\header::status(404);
		}

		if($module === 'v6')
		{
			\content_api\v6::master_check();
		}

		// save api log
		\dash\app\apilog::start();
	}
}
?>