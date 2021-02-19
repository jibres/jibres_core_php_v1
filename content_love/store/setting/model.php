<?php
namespace content_love\store\setting;


class model
{
	public static function post()
	{
		if(\dash\request::post('reenable') === 'reenable')
		{
			\lib\app\store\remove::back(\dash\request::get('id'));
		}

		if(\dash\request::post('setenterprise'))
		{
			$enterprise = \dash\request::post('enterprise');

			\lib\app\store\edit::change_enterprise($enterprise, \dash\request::get('id'));
		}

		if(\dash\request::post('set_storage'))
		{
			$storage = \dash\request::post('storage');
			$uploadsize = \dash\request::post('uploadsize');

			\lib\app\store\edit::change_storage($storage, $uploadsize, \dash\request::get('id'));
		}

		if(\dash\request::post('subdomain'))
		{
			$subdomain = \dash\request::post('subdomain');

			\lib\app\store\edit::change_subdomain($subdomain, \dash\request::get('id'));
		}

	}
}
?>
