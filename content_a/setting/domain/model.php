<?php
namespace content_a\setting\domain;


class model
{
	public static function post()
	{
		// {"connectdomain":"connectdomain", "type": $("#worktype").text(), "domain": $("#workondomain").text()}
		if(\dash\request::post('connectdomain') === 'connectdomain')
		{
			$type   = \dash\request::post('type');
			$domain = \dash\request::post('domain');

			\lib\app\store\domain::domain_action($type, $domain);
			return;
		}


		\dash\session::set('businessRemoveDomain', null);
		\dash\session::set('businessNewDomain', null);

		if(\dash\request::post('remove') === 'domain')
		{
			$post =
			[
				'domain' => \dash\request::post('domain'),
			];

			$result = \lib\app\store\domain::remove($post);
		}
		else
		{
			$post =
			[
				'domain' => \dash\request::post('domain'),
			];

			$result = \lib\app\store\domain::set($post);
		}


		if(\dash\engine\process::status())
		{
			\lib\store::refresh();
			\dash\redirect::pwd();
		}
	}


}
?>