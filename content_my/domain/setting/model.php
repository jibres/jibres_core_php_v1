<?php
namespace content_my\domain\setting;


class model
{
	public static function post()
	{
		if(\dash\request::post('myaction') == 'autorenew')
		{
			$autorenew = \dash\request::post('op') == 'set' ? 1 : 0;

			if(\lib\nic\mode::api())
			{
				$get_api     = new \lib\nic\api();
				$load_domain = $get_api->domain_autorenew(\dash\data::domainDetail_id(), $autorenew);
			}
			else
			{
				$result = \lib\app\nic_domain\edit::edit(['autorenew' => $autorenew], \dash\data::domainDetail_id());
			}

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}

		if(\dash\request::post('status') == 'remove')
		{
			if(\lib\nic\mode::api())
			{
				$get_api     = new \lib\nic\api();
				$load_domain = $get_api->domain_delete(\dash\data::domainDetail_id());
			}
			else
			{
				$result = \lib\app\nic_domain\remove::remove(\dash\data::domainDetail_id());
			}

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this());
			}
			return;
		}
	}
}
?>