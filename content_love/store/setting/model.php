<?php
namespace content_love\store\setting;


class model
{
	public static function post()
	{
		if(\dash\request::post('subdomain'))
		{
			$subdomain = \dash\request::post('subdomain');

			\lib\app\store\edit::change_subdomain($subdomain, \dash\request::get('id'));
		}

	}
}
?>
