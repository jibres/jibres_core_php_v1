<?php
namespace content_api;


class controller
{
	public static function routing()
	{
		$module = \dash\url::module();

		if(!$module || ($module === 'doc' && !\dash\url::child()) || (in_array($module, ['v1'])))
		{
			// nothing
		}
		else
		{
			\dash\header::status(404, T_("Invalid url"));
		}

		if($module === 'v1')
		{
			\content_api\v1::master_check();
		}

		// save api log
		\dash\app\apilog::start();
	}
}
?>